<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
class CurrencyController extends Controller
{
    public function changeCurrency($currency)
    {
        // Allowed currencies
       
        $currencies = DB::table('currencies')->get();
        //  return $currencies ;
       
           $availableCurrencies = [];

              foreach ($currencies as $cur) {
                       $availableCurrencies[] = $cur->code;
                   }


        if (in_array($currency, $availableCurrencies)) {
            Session::put('currency', $currency);
        }

        return redirect()->back()->with('success', __('common.currency_changed') . $currency);
    }
    public function sync($secret_code)
    {
        $response= app('website_data');
        //return $response->body();
        
       if ($response->successful()) { 
        $data = $response->json();
    $website = $data[0]; 
    $products = $website['products'];
    $categories = $website['categories']; 
    $currencies = $website['currencies']; 
           
DB::table('currencies')->truncate();
DB::table('categories')->truncate();
DB::table('products')->truncate();
DB::table('miscs')->truncate();
           
        //    return $currencies;


           DB::transaction(function () use ($website) {

    $products = $website['products'];
    $categories = $website['categories']; 
    $currencies = $website['currencies'];
    $miscs= $website['miscs'];

  
    
    foreach ($currencies as $currency) {
        DB::table('currencies')->insert([
            // 'id'            => $c++,
            'website_id'    => $currency['website_id'],
            'code'          => $currency['code'],
            'symbol'        => $currency['symbol'],
            'name'          => $currency['name'],
            'exchange_rate' => $currency['exchange_rate'],
            'is_default'    => $currency['is_default'],
            
        ]);
    }

               //Categories  Data Upload
    
      $c=0;
    foreach ($categories as $category) {
        DB::table('categories')->insert([
             //'id'            => $c++,
            'title'    => $category['title'],
            'title_jp'    => $category['title_jp'],
            'slug'    => $category['slug'],
            'summary'    => $category['summary'],
            'summary_jp'    => $category['summary_jp'],
            'photo'    => $category['photo'],
            'status'    => $category['status'],
        ]);
    }
               //Products  Data Upload
     
      $p=0;
    foreach ($products as $product) {
        DB::table('products')->insert([
             //'id'            => $p++,
            'title'             => $product['title'],
            'title_jp'          => $product['title_jp'],
            'slug'              => $product['slug'],
            'summary'           => $product['summary'],
            'summary_jp'        => $product['summary_jp'],
            'description'       => $product['description'],
            'description_jp'    => $product['description_jp'],
            'meta_title'        => $product['meta_title'],
            'meta_description'  => $product['meta_description'],
            'meta_keyword'      => $product['meta_keyword'],
            'photo'             => $product['photo'],
            'status'            => $product['status'],
            'price'            => $product['price'],
            'price_jp'            => $product['price_jp'],
            'price_hk'            => $product['price_hk'],
            'discount'            => $product['discount'],
            'extra_description'        => $product['extra_description'],
            'extra_description_jp'     => $product['extra_description_jp'],
            'cat_id'            => $product['cat_id'],
            'duration'          => $product['duration'],
            'skill_level'       => $product['skill_level'],
            'skill_level_jp'    => $product['skill_level_jp'],
            'lectures'          => $product['lectures'],
            'language'          => $product['language'] ?? 'A',
            'language_jp'       => $product['language_jp'] ?? 'A',
        ]);
    }
    
        foreach ($miscs as $misc) {
        DB::table('miscs')->insert([
          
            'name'          => $misc['name'],
            'value' => $misc['value'],
            
            
        ]);
    }  
               
                   });
            
  
            
                        return redirect()->route('home')->with('success', __('common.tables_updated'));

     
        //    dd($categories);
    } else {
        $products = [];$categories = [];
    }
       

       
    }
}
