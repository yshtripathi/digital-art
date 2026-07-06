<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class PointGatingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Please login to continue.');
        }

        $user = Auth::user();
        
        // Check if user is trying to access a course purchase or checkout with courses
        if ($request->routeIs('checkout')) {
            $user_id = $user->id;
            $cartItems = Cart::where('user_id', $user_id)->where('order_id', null)->get();
            
            foreach ($cartItems as $item) {
                // Assuming product_id < 1000 are courses (as per reference app logic)
                if ($item->product_id < 1000) {
                    $course = $item->product;
                    if($course) {
                        $priceInPoints = $course->price_in_points ?? $course->price; // Fallback to USD price if points not set
                        
                        if ($user->points_balance < $priceInPoints) {
                            return redirect()->route('points.topup')->with('error', 'Insufficient points to purchase ' . $course->title . '. Please top up your balance.');
                        }
                    }
                }
            }
        }

        return $next($request);
    }
}
