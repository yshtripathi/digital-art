<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\User;
use DB;
use Auth;
use Helper;
use Illuminate\Support\Str;

class PointsController extends Controller
{
    /**
     * Display the user's points dashboard with transaction history.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $transactions = DB::table('point_transactions')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('frontend.pages.points-dashboard', compact('user', 'transactions'));
    }

    /**
     * Show the top-up page with available point bundles.
     */
    public function topup()
    {
        // Available point bundles for purchase
        $bundles = [
            ['id' => 1001, 'points' => 100, 'price' => 100, 'title' => 'Starter Pack', 'description' => 'Perfect for a single course.'],
            ['id' => 1002, 'points' => 1000, 'price' => 500, 'title' => 'Growth Pack', 'description' => 'Get 2x points on your purchase.'],
            ['id' => 1003, 'points' => 2500, 'price' => 1000, 'title' => 'Pro Pack', 'description' => 'Get 2.5x points on your purchase.'],
            ['id' => 1004, 'points' => 4500, 'price' => 1500, 'title' => 'Elite Pack', 'description' => 'Get 3x points on your purchase.'],
        ];
        
        return view('frontend.pages.topup', compact('bundles'));
    }

    /**
     * Add a point bundle or custom point amount to the cart.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        if (!session('guest')) {
            session(['guest' => rand(100000, 999999)]);
        }
        $user_id = Auth::id() ?? session('guest');

        // Business Rule: Prevent mixing points and courses in the same transaction
        $existing_item = Cart::where('user_id', $user_id)->where('order_id', null)->pluck('product_id')->first();
        if (isset($existing_item) && $existing_item < 1000) {
            return back()->with('error', __('common.cannot_add_points_with_courses'));
        }

        $input_amount = (float)$request->amount;
        
        // Fixed exchange rates for multi-currency support
        $usd_rate_jp = 160.0;
        $usd_rate_hk = 7.82;

        // Convert the input amount to USD if it was entered in JPY
        if (session('currency') == 'JPY') {
            $usd_amount = $input_amount / $usd_rate_jp;
        } else {
            $usd_amount = $input_amount;
        }
        
        // Progressive multiplier logic: the more you spend, the more bonus points you receive
        $points = match(true) {
            $usd_amount >= 1500 => round($usd_amount * 2.5),
            $usd_amount >= 1000 => round($usd_amount * 2),
            $usd_amount >= 500 => round($usd_amount * 1.5),
            default => round($usd_amount)
        };

        $already_cart = Cart::where('user_id', $user_id)->where('order_id', null)->where('product_id', 1000)->first();

        if ($already_cart) {
            $new_usd_amount = $already_cart->price + $usd_amount;
            
            // Re-calculate points based on the new total tier
            $total_points = match(true) {
                $new_usd_amount >= 1500 => round($new_usd_amount * 2.5),
                $new_usd_amount >= 1000 => round($new_usd_amount * 2),
                $new_usd_amount >= 500 => round($new_usd_amount * 1.5),
                default => round($new_usd_amount)
            };

            $already_cart->price = $new_usd_amount;
            $already_cart->price_jp = $new_usd_amount * $usd_rate_jp;
            $already_cart->price_hk = $new_usd_amount * $usd_rate_hk;
            $already_cart->amount = $already_cart->price;
            $already_cart->amount_jp = $already_cart->price_jp;
            $already_cart->amount_hk = $already_cart->price_hk;
            $already_cart->points = $total_points;
            $already_cart->save();
        } else {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->product_id = 1000; // Reserved ID for points
            $cart->price = $usd_amount;
            $cart->price_jp = $usd_amount * $usd_rate_jp;
            $cart->price_hk = $usd_amount * $usd_rate_hk;
            $cart->quantity = 1;
            $cart->amount = $cart->price;
            $cart->amount_jp = $cart->price_jp;
            $cart->amount_hk = $cart->price_hk;
            $cart->points = $points;
            $cart->save();
        }

        return redirect()->route('cart')->with('success', __('common.points_added_to_cart'));
    }

    /**
     * Redeem points to enroll in courses.
     */
    public function redeem(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login.form')->with('error', __('common.login_to_redeem_points'));
        }

        // Calculate total points required for the current cart
        $totalPointsNeeded = Helper::totalCartPoints();
        
        if ($totalPointsNeeded <= 0) {
            return back()->with('error', __('common.cart_no_course_enrollments'));
        }

        // Security Check: Ensure user has enough accumulated points
        if ($user->points_balance < $totalPointsNeeded) {
            return redirect()->route('points.topup')->with('error', __('common.insufficient_points'));
        }

        try {
            DB::beginTransaction();

            // 1. Deduct points from user wallet
            $user->decrement('points_balance', $totalPointsNeeded);

            // 2. Log the transaction for audit history
            DB::table('point_transactions')->insert([
                'user_id' => $user->id,
                'amount' => -$totalPointsNeeded,
                'type' => 'debit',
                'description' => 'Course Enrollment via Points',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Create a professional order record
            $cartItems = Cart::where('user_id', $user->id)->where('order_id', null)->get();
            
            $order = new Order();
            $order->order_number = 'ORD-PTS-' . strtoupper(Str::random(10));
            $order->user_id = $user->id;
            $order->sub_total = 0; // Point-based purchase has 0 cash subtotal
            $order->total_amount = 0;
            $order->quantity = $cartItems->sum('quantity');
            $order->payment_status = 'Completed';
            $order->status = 'Completed';
            
            // Populate essential billing info from user profile
            $order->first_name = $user->name;
            $order->last_name = $user->last_name ?? '';
            $order->email = $user->email;
            $order->address1 = $user->address ?? 'Digital Enrollment';
            $order->phone = $user->phone ?? 'N/A';
            $order->country = $user->country ?? 'N/A';
            $order->post_code = $user->post_code ?? '0000';
            $order->save();

            // 4. Link cart items to the new order to finalize the transaction
            Cart::where('user_id', $user->id)->where('order_id', null)->update(['order_id' => $order->id]);

            DB::commit();

            return redirect()->route('coursecart')->with('success', __('common.enrollment_successful'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('common.enrollment_error'));
        }
    }
}
