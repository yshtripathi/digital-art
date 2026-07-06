<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\PostComment;
use App\Rules\MatchOldPassword;
use Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index() {
        if(auth()->user()->role == "user") {
            // Get all orders with cart info
            $allOrders = Order::with('cart_info')
                ->orderBy('id', 'DESC')
                ->where('user_id', auth()->user()->id)
                ->get();

            // Split into purchased (wallet top-ups) and redeemed (course enrollments)
            $purchasedOrders = $allOrders->filter(function($order) {
                $cartItem = $order->cart_info->first();
                return $cartItem && $cartItem->product_id == 1000;
            });

            $redeemedOrders = $allOrders->filter(function($order) {
                $cartItem = $order->cart_info->first();
                return $cartItem && $cartItem->product_id < 1000;
            });

            return view('frontend.user.dashboard')
                ->with('purchasedOrders', $purchasedOrders)
                ->with('redeemedOrders', $redeemedOrders);
        }
        else {
            return view('user.index');
        }
    }

    public function profile(){
        $profile=Auth()->user();
        // return $profile;
        return view('user.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id){
        // return $request->all();
        $user=User::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success',__('common.profile_updated_successfully'));
        }
        else{
            request()->session()->flash('error',__('common.try_again'));
        }
        return redirect()->back();
    }

    // Order
    public function orderIndex(){
        $orders=Order::orderBy('id','DESC')->where('user_id',auth()->user()->id)->paginate(10);
        return view('user.order.index')->with('orders',$orders);
    }
    public function userOrderDelete($id)
    {
        $order=Order::find($id);
        if($order){
           if($order->status=="process" || $order->status=='delivered' || $order->status=='cancel'){
                return redirect()->back()->with('error',__('common.cannot_delete_order'));
           }
           else{
                $status=$order->delete();
                if($status){
                    request()->session()->flash('success',__('common.order_deleted_successfully'));
                }
                else{
                    request()->session()->flash('error',__('common.order_delete_failed'));
                }
                return redirect()->route('user.order.index');
           }
        }
        else{
            request()->session()->flash('error',__('common.order_not_found'));
            return redirect()->back();
        }
    }

    public function orderShow($id)
    {
        $order = Order::find($id);
         //return  $order->total_amount;
        return view('frontend.user.order.show')->with('order',$order);
    }
    // Product Review
    public function productReviewIndex(){
        $reviews=ProductReview::getAllUserReview();
        return view('user.review.index')->with('reviews',$reviews);
    }

    public function productReviewEdit($id)
    {
        $review=ProductReview::find($id);
        // return $review;
        return view('user.review.edit')->with('review',$review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewUpdate(Request $request, $id)
    {
        $review=ProductReview::find($id);
        if($review){
            $data=$request->all();
            $status=$review->fill($data)->update();
            if($status){
                request()->session()->flash('success',__('common.review_updated_successfully'));
            }
            else{
                request()->session()->flash('error',__('common.something_went_wrong'));
            }
        }
        else{
            request()->session()->flash('error',__('common.review_not_found'));
        }

        return redirect()->route('user.productreview.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewDelete($id)
    {
        $review=ProductReview::find($id);
        $status=$review->delete();
        if($status){
            request()->session()->flash('success',__('common.review_deleted_successfully'));
        }
        else{
            request()->session()->flash('error',__('common.something_went_wrong'));
        }
        return redirect()->route('user.productreview.index');
    }

    public function userComment()
    {
        $comments=PostComment::getAllUserComments();
        return view('user.comment.index')->with('comments',$comments);
    }
    public function userCommentDelete($id){
        $comment=PostComment::find($id);
        if($comment){
            $status=$comment->delete();
            if($status){
                request()->session()->flash('success',__('common.post_comment_deleted_successfully'));
            }
            else{
                request()->session()->flash('error',__('common.error_occurred_try_again'));
            }
            return back();
        }
        else{
            request()->session()->flash('error',__('common.post_comment_not_found'));
            return redirect()->back();
        }
    }
    public function userCommentEdit($id)
    {
        $comments=PostComment::find($id);
        if($comments){
            return view('user.comment.edit')->with('comment',$comments);
        }
        else{
            request()->session()->flash('error',__('common.comment_not_found'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userCommentUpdate(Request $request, $id)
    {
        $comment=PostComment::find($id);
        if($comment){
            $data=$request->all();
            // return $data;
            $status=$comment->fill($data)->update();
            if($status){
                request()->session()->flash('success',__('common.comment_updated_successfully'));
            }
            else{
                request()->session()->flash('error',__('common.something_went_wrong'));
            }
            return redirect()->route('user.post-comment.index');
        }
        else{
            request()->session()->flash('error',__('common.comment_not_found'));
            return redirect()->back();
        }

    }

    public function changePassword(){
        return view('user.layouts.userPasswordChange');
    }
    public function changPasswordStore(Request $request)
    { //return $request;
       $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   if ($validator->fails()) {
    // Manually handle failure
    return redirect()->back()
        ->withErrors($validator)
        ->withInput()
        ->with('error', __('common.please_check_inputs'));
}
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('user')
        ->with('success',__('common.password_successfully_changed'));
        // ->session()->flash('success','Password successfully changed');
        // 
    }

    
}
