<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Str;
use Helper;
use Illuminate\Support\Facades\Session;use DB;
class CartController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function addToCart(Request $request){
        // dd($request->all());
        if (empty($request->slug)) {
            request()->session()->flash('error',__('common.invalid_products'));
            return back();
        }

        //$product = Product::where('slug', $request->slug)->first();
        $product = Product::getProductBySlug($request->slug);

         //return $product;
        if (empty($product)) {
            request()->session()->flash('error',__('common.invalid_products'));
            return back();
        }

        // Business Rule: Prevent mixing products and points in the same transaction
        $existing_items = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->pluck('product_id')->toArray();
        if (!empty($existing_items)) {
            $hasPoints = in_array(true, array_map(function($id) { return $id >= 1000; }, $existing_items));
            if ($hasPoints) {
                return back()->with('error', __('common.cannot_add_products_with_points'));
            }
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
        // return $already_cart;
        if($already_cart) {
            // dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $product->price + $already_cart->amount;
            $already_cart->amount_jp = $product->price_jp + $already_cart->amount_jp;
            $already_cart->amount_hk = $product->price_hk + $already_cart->amount_hk;
            // return $already_cart->quantity;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0)
                return back()->with('error',__('common.stock_not_sufficient'));
            $already_cart->save();
            
        }
        else
        {
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->currency = session("currency", "USD");
            $cart->price = $product->price;
            $cart->price_jp = $product->price_jp;
            $cart->price_hk = $product->price_hk;
            $cart->quantity = 1;
            $cart->amount = $cart->price * $cart->quantity;
            $cart->amount_jp = $cart->price_jp * $cart->quantity;
            $cart->amount_hk = $cart->price_hk * $cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error',__('common.stock_not_sufficient'));
            $cart->save();
            $wishlist=Wishlist::where('user_id',auth()->user()->id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success',__('common.product_added_to_cart'));
        return redirect()->route('cart');       
    }  

    public function singleAddToCart(Request $request){
        $request->validate([
            'slug'      =>  'required',
            'quant'      =>  'required',
        ]);
        // dd($request->quant[1]);
 //return $request;

            //$cart->price = $product->price;
            //$cart->price_jp = $product->price_jp;
            //$cart->price_hk = $product->price_hk;
        
        //$product = Product::where('slug', $request->slug)->first();
        $product = Product::getProductBySlug($request->slug);
        $level = DB::table('product_levels')->find($request->level_id); //return $level;
        if($request->price){
            $true_price = $level->price;
            $true_price_jp = $level->price_jp;
            $true_price_hk = $level->price_hk;
            $true_points = $level->price_in_points;
        }
        
        
 //return $product;
        if($product->stock <$request->quant[1]){
            return back()->with('error',__('common.out_of_stock'));
        }
        if ( ($request->quant[1] < 1) || empty($product) ) {
            request()->session()->flash('error',__('common.invalid_products'));
            return back();
        }

        // Business Rule: Prevent mixing products and points in the same transaction
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        } else {
            if (!session('guest')) {
                Session::put('guest', rand(100000, 999999));
            }
            $user_id = session('guest');
        }

        $existing_items = Cart::where('user_id', $user_id)->where('order_id', null)->pluck('product_id')->toArray();
        if (!empty($existing_items)) {
            $hasPoints = in_array(true, array_map(function($id) { return $id >= 1000; }, $existing_items));
            if ($hasPoints) {
                return back()->with('error', __('common.cannot_add_products_with_points'));
            }
        }

if (Auth::check()) {
        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
}

else {

    if (!session('guest')) {
    Session::put('guest', rand(100000, 999999));
     }
    $guest= session('guest');   
     
        $already_cart = Cart::where('user_id', $guest)->where('order_id',null)->where('product_id', $product->id)->first();
}
        // return $already_cart;
//$already_cart='';

        if($already_cart) {
            return back()->with('error',__('common.product_already_in_cart'));
            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            // $already_cart->price = ($product->price * $request->quant[1]) + $already_cart->price ;
            $already_cart->amount = ($true_price * $request->quant[1])+ $already_cart->amount;
            $already_cart->amount_jp = ($true_price_jp * $request->quant[1])+ $already_cart->amount_jp;
            $already_cart->amount_hk = ($true_price_hk * $request->quant[1])+ $already_cart->amount_hk;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error',__('common.stock_not_sufficient'));

            $already_cart->save();
            
        }
        else
        {
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id ?? $guest;
            $cart->product_id = $product->id;
            // $cart->currency = session("currency", "USD");
            $cart->price = $true_price;
            $cart->price_jp = $true_price_jp;
            $cart->price_hk = $true_price_hk;
            $cart->points = $true_points;
            $cart->quantity = $request->quant[1];
            $cart->amount = $cart->price * $cart->quantity;
            $cart->amount_jp = $cart->price_jp * $cart->quantity;
            $cart->amount_hk = $cart->price_hk * $cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error',__('common.stock_not_sufficient'));
            // return $cart;
            $cart->save();
        }
        request()->session()->flash('success',__('common.product_added_to_cart'));
        return redirect()->route('coursecart');       
    } 
    
    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success',__('common.cart_removed_successfully'));
            return back();  
        }
        request()->session()->flash('error',__('common.error_try_again'));
        return back();       
    }     

    public function cartUpdate(Request $request){
        // dd($request->all());
        if($request->quant){
            $error = array();
            $success = '';
            // return $request->quant;
            foreach ($request->quant as $k=>$quant) {
                // return $k;
                $id = $request->qty_id[$k];
                // return $id;
                $cart = Cart::find($id);
                // return $cart;
                if($quant > 0 && $cart) {
                    // return $quant;

                    /*if($cart->product->stock < $quant){
                        request()->session()->flash('error',__('common.out_of_stock'));
                        return back();
                    }*/

                    //$cart->quantity = ($cart->product->stock > $quant) ? $quant  : $cart->product->stock;
                    $cart->quantity = $quant;
                    // return $cart;
                    
                    //if ($cart->product->stock <=0) continue;
                    $after_price=($cart->product->price-($cart->product->price*$cart->product->discount)/100);
                    $cart->amount = $after_price * $quant;
                    // return $cart->price;



                    $updatAmount = ($cart->product->price) * $quant;
                    $updatAmount_JP = ($cart->product->price_jp) * $quant;
                    $updatAmount_HK = ($cart->product->price_hk) * $quant;
                    Cart::where('id', $id)->update(['quantity' => $quant, 'amount' => $updatAmount, 'amount_jp' => $updatAmount_JP,'amount_hk' => $updatAmount_HK]);

                    

                    //$cart->save();
                    $success = __('common.cart_successfully_updated');
                }else{
                    $error[] = __('common.cart_invalid');
                }
            }
            return back()->with($error)->with('success', $success);
        }else{
            return back()->with('error',__('common.cart_invalid'));
        }    
    }

    // public function addToCart(Request $request){
    //     // return $request->all();
    //     if(Auth::check()){
    //         $qty=$request->quantity;
    //         $this->product=$this->product->find($request->pro_id);
    //         if($this->product->stock < $qty){
    //             return response(['status'=>false,'msg'=>'Out of stock','data'=>null]);
    //         }
    //         if(!$this->product){
    //             return response(['status'=>false,'msg'=>'Product not found','data'=>null]);
    //         }
    //         // $session_id=session('cart')['session_id'];
    //         // if(empty($session_id)){
    //         //     $session_id=Str::random(30);
    //         //     // dd($session_id);
    //         //     session()->put('session_id',$session_id);
    //         // }
    //         $current_item=array(
    //             'user_id'=>auth()->user()->id,
    //             'id'=>$this->product->id,
    //             // 'session_id'=>$session_id,
    //             'title'=>$this->product->title,
    //             'summary'=>$this->product->summary,
    //             'link'=>route('product-detail',$this->product->slug),
    //             'price'=>$this->product->price,
    //             'photo'=>$this->product->photo,
    //         );
            
    //         $price=$this->product->price;
    //         if($this->product->discount){
    //             $price=($price-($price*$this->product->discount)/100);
    //         }
    //         $current_item['price']=$price;

    //         $cart=session('cart') ? session('cart') : null;

    //         if($cart){
    //             // if anyone alreay order products
    //             $index=null;
    //             foreach($cart as $key=>$value){
    //                 if($value['id']==$this->product->id){
    //                     $index=$key;
    //                 break;
    //                 }
    //             }
    //             if($index!==null){
    //                 $cart[$index]['quantity']=$qty;
    //                 $cart[$index]['amount']=ceil($qty*$price);
    //                 if($cart[$index]['quantity']<=0){
    //                     unset($cart[$index]);
    //                 }
    //             }
    //             else{
    //                 $current_item['quantity']=$qty;
    //                 $current_item['amount']=ceil($qty*$price);
    //                 $cart[]=$current_item;
    //             }
    //         }
    //         else{
    //             $current_item['quantity']=$qty;
    //             $current_item['amount']=ceil($qty*$price);
    //             $cart[]=$current_item;
    //         }

    //         session()->put('cart',$cart);
    //         return response(['status'=>true,'msg'=>'Cart successfully updated','data'=>$cart]);
    //     }
    //     else{
    //         return response(['status'=>false,'msg'=>'You need to login first','data'=>null]);
    //     }
    // }

    // public function removeCart(Request $request){
    //     $index=$request->index;
    //     // return $index;
    //     $cart=session('cart');
    //     unset($cart[$index]);
    //     session()->put('cart',$cart);
    //     return redirect()->back()->with('success','Successfully remove item');
    // }

    public function checkout(Request $request){
        // return $request;
        $cart=session('cart');
        // return $cart;
        // $cart_index=\Str::random(10);
        // $sub_total=0;
        // foreach($cart as $cart_item){
        //     $sub_total+=$cart_item['amount'];
        //     $data=array(
        //         'cart_id'=>$cart_index,
        //         'user_id'=>$request->user()->id,
        //         'product_id'=>$cart_item['id'],
        //         'quantity'=>$cart_item['quantity'],
        //         'amount'=>$cart_item['amount'],
        //         'status'=>'new',
        //         'price'=>$cart_item['price'],
        //     );

        //     $cart=new Cart();
        //     $cart->fill($data);
        //     $cart->save();
        // }
        return view('frontend.pages.checkout');
    }
}
