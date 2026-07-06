<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class Product extends Model
{
    protected $fillable=['title', 'title_jp', 'summary_jp', 'description_jp', 'extra_description', 'extra_description_jp','slug','summary','description','cat_id','child_cat_id','price', 'price_jp', 'price_hk','brand_id','discount','status','photo','size','stock','is_featured','condition'];

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function levels()
{
    return $this->hasMany(ProductLevel::class, 'course_id', 'id');
}
    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    public static function getAllProduct(){
        return Product::with(['cat_info','sub_cat_info'])->orderBy('id','desc')->paginate(10);
    }
    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    public function getReview(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    public static function getCurrencySymbol()
    {
        $currency = session('currency', 'USD'); // Default to USD

        $symbols = [
            'USD' => '$',
            'JPY' => '¥',
            'HKD' => 'HK$',
        ];

        return $symbols[$currency] ?? $currency;
    }
    public static function getProductBySlug_1($slug) {

        $currentLocale = App::getLocale();

        $currency = session('currency', 'USD');

        if($currentLocale == "ja") {
            if($currency == "USD") {
                return Product::with(['cat_info','rel_prods','getReview'])->select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level',
                    'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
            else if($currency == "HKD") {
                return Product::with(['cat_info','rel_prods','getReview'])->select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level',
                     'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
            else {
                return Product::with(['cat_info','rel_prods','getReview'])->select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price_jp as price',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level',
                    'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
        }
        else {
          
            if($currency == "USD") {
                return Product::with(['cat_info','rel_prods','getReview'])->select(
                    'id',
                    'title',
                    'summary',
                    'description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',                    
                    'lectures',
                 'skill_level',
                     'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
            else if($currency == "HKD") {
                return Product::with(['cat_info','rel_prods','getReview'])->select(
                    'id',
                    'title',
                    'summary',
                    'description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level',
                      'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
            else {
                return Product::with(['cat_info','rel_prods','getReview'])->select(
                    'id',
                    'title',
                    'summary',
                    'description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level',
                    'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
        }
    }
    public static function getProductBySlug($slug) {

        $currentLocale = App::getLocale();

        $currency = session('currency', 'USD');

        if($currentLocale == "ja") {
            if($currency == "USD") {
               // return Product::with(['cat_info','rel_prods','getReview'])->select(
                return Product::with([
    'levels' => function($query) {
        $query->select(
            'id',
            'course_id',
            'skill_level_jp as skill_level',
            'purpose_jp as purpose',
            'learn_info_jp as learn_info',
            'outcome_jp as outcome',
            'price as price',
            'price_in_points'
        );
    },
    'cat_info',
    'rel_prods',
    'getReview'
])->select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level_jp as skill_level',
                    'language_jp as language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
            else if($currency == "HKD") {
                //return Product::with(['cat_info','rel_prods','getReview'])->select(
                 return Product::with([
    'levels' => function($query) {
        $query->select(
            'id',
            'course_id',
            'skill_level',
            'purpose',
            'learn_info',
            'outcome',
            'price_hk as price'
        );
    },
    'cat_info',
    'rel_prods',
    'getReview'
])->select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level_jp as skill_level',
                    'language_jp as language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
            else {
                return Product::with([
    'levels' => function($query) {
        $query->select(
            'id',
            'course_id',
            'skill_level',
            'purpose',
            'learn_info',
            'outcome',
            'price_jp as price',
            'price_in_points'
        );
    },
    'cat_info',
    'rel_prods',
    'getReview'
])->with(['cat_info','rel_prods','getReview'])->select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',                    
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level_jp as skill_level',
                    'language_jp as language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
        }
        else {
            //return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();

            if($currency == "USD") {
               // return Product::with(['cat_info','rel_prods','getReview'])->select(
                return Product::with([
    'levels' => function($query) {
        $query->select(
            'id',
            'course_id',
            'skill_level',
            'purpose',
            'learn_info',
            'outcome',
            'price as price',
            'price_in_points'
        );
    },
    'cat_info',
    'rel_prods',
    'getReview'
])->select(
                    'id',
                    'title',
                    'summary',
                    'description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',                    
                    'lectures',
                 'skill_level',
                     'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
            else if($currency == "HKD") {
               // return Product::with(['cat_info','rel_prods','getReview'])->select(
                return Product::with([
    'levels' => function($query) {
        $query->select(
            'id',
            'course_id',
            'skill_level',
            'purpose',
            'learn_info',
            'outcome',
            'price_hk as price'
        );
    },
    'cat_info',
    'rel_prods',
    'getReview'
])->select(
                    'id',
                    'title',
                    'summary',
                    'description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level',
                      'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
            else {
                return Product::with([
    'levels' => function($query) {
        $query->select(
            'id',
            'course_id',
            'skill_level',
            'purpose',
            'learn_info',
            'outcome',
            'price_jp as price',
            'price_in_points'
        );
    },
    'cat_info',
    'rel_prods',
    'getReview'
])->with(['cat_info','rel_prods','getReview'])->select(
                    'id',
                    'title',
                    'summary',
                    'description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'extra_description_jp',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'lectures',
                    'skill_level',
                    'language',
                    'created_at',
                    'updated_at'
                    )->where('slug',$slug)->first();
            }
        }
    }
    public static function countActiveProduct(){
        $data=Product::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }

}
