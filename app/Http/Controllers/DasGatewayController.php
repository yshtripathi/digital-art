<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use DB;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
class DasGatewayController extends Controller
{
    public function payment(Request $request) {
        $order_data = $request->all();
 
        $cart = Cart::where('user_id',auth()->user()->id)->where('order_id', $order_data["oid"])->get()->toArray();
       
        $data = [];
       
        // return $cart;
        $data['items'] = array_map(function ($item) use($cart) {
            $name=Product::where('id',$item['product_id'])->pluck('title');
            return [
                'name' =>$name ,
                'price' => $item['price'],
                'desc'  => 'Thank you for using credit card',
                'qty' => $item['quantity']
            ];
        }, $cart);
 
        $data['invoice_id'] = 'ORD-'.strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.failed');
 
        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }
 
        $data['total'] = $total;
 
 
        //Get Transaction Status
        $url = env("PAYMENT_STATUS_URL")."/".$order_data["transaction_id"];
 
        $headers = array(
            "Authorization: BASIC ".env('SECRET_KEY'),
            'x-api-key: '.env('X_API_KEY'),
            "Content-Type: application/json",
            "x-secret-key: We@ve"
        );
 
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
 
        $curl_response = curl_exec($curl);
        curl_close ($curl);
        $result = json_decode($curl_response);
 
        $orderInfo = Order::where('user_id', auth()->user()->id)->where('id', $order_data["oid"])->first();
        //dd($result);
 
        if($result->success) {
            // Mail::to(auth()->user()->email)->bcc('ashutosh.singh@unlink-technologies.com')->send(new OrderConfirmationMail($orderInfo));
            $email_status = DB::table('miscs')->where('name', 'Email Status')->value('value') ?? 'inactive';
        if ($email_status !== 'active') {$email_status='inactive';}
         else {
                   try {
  Mail::to(auth()->user()->email)->bcc('bccunlink@gmail.com')->send(new OrderConfirmationMail($orderInfo));
                          $email_status='active';
                        } catch (\Exception $e) {
                      \Log::error($e->getMessage());
                          $email_status='inactive';
                        }
            }
            Order::where('user_id', auth()->user()->id)->where('id', $order_data["oid"])->update(["payment_status" => "Completed", "trans_id" => $order_data["transaction_id"], "status" => "Completed"]);
            
            // Credit purchased points once. Point top-ups are stored on cart.points.
            $order = Order::with('cart')->find($order_data["oid"]);
            $pointsToCredit = $order->cart
                ->where('product_id', '>=', 1000)
                ->sum('points');

            $alreadyCredited = DB::table('point_transactions')
                ->where('user_id', auth()->id())
                ->where('type', 'credit')
                ->where('reference_id', $order->id)
                ->exists();

            if($pointsToCredit > 0 && !$alreadyCredited) {
                $user = auth()->user();
                $user->increment('points_balance', $pointsToCredit);

                DB::table('point_transactions')->insert([
                    'user_id' => $user->id,
                    'amount' => $pointsToCredit,
                    'type' => 'credit',
                    'description' => 'Points purchase',
                    'reference_id' => $order->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return view('frontend.pages.order-success')->with('transaction_id', $order_data["transaction_id"])->with('orderInfo', $orderInfo)->with('email_status', $email_status);
        }
        else {
            Order::where('user_id', auth()->user()->id)->where('id', $order_data["oid"])->update(["payment_status" => "Failed", "trans_id" => $order_data["transaction_id"], "status" => "Payment Failed"]);
            return view('frontend.pages.order-failed')->with('order', $order_data)->with('orderInfo', $orderInfo);
        }
    }

   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $order_data = $request->all();
        dd($order_data);
        return view('frontend.pages.order-success')->with('order', $order_data);
    }

    public function failed(Request $request)
    {
        $order_data = $request->all();
        return view('frontend.pages.order-failed')->with('order', $order_data);
    }
}
