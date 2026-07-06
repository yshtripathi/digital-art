
@extends('frontend.layouts.main')
@section('main-content')

<div class="nk-gap-1"></div>
<div class="breadcr-info">
   <div class="container">
                <ul class="nk-breadcrumbs">
                    <li><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li><a href="">Database</a></li>
                    <li><i class="fa fa-angle-right"></i></li>                
                    <li><span>Database</span></li>
                </ul>

                
               
             
            </div>
 </div>

<div class="nk-gap-3"></div>
<div class="srvce-lst">
  <div class="container">
      <div class="row">
        
        <div class="col-md-12 col-12">          
        <div id="content" class="tab-content srvcetb-cntnt" role="tablist" >            
        <div id="pane-all" class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-all" data-aos="fade-up">
            <div role="tab" id="heading-A">
                <h5>
                    <!-- Note: `data-parent` removed from here -->
                    <a data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
                    Discount Bundles
                    </a>
                </h5>
            </div>
            <!-- Note: New place of `data-parent` -->
            <div id="collapse-A" class="collapse show" data-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                     <div class="gmessv-lst">
                       <h3 class="nk-decorated-h"><span>Database</span></h3>
                     <div class="nk-gap-1"></div>

                        <div class="row m-0 mb-3">
                          @php                        

                          if(isset($_GET['page']))
                          {
                          $page=$_GET['page']*40;
                          $skip=($_GET['page']-1)*40;
                          }
                          else {$page=40;$skip=0;}
                          
                  $products = Helper::getRandomProduct(320);
                          @endphp
                          
                           @if(count($products))
         @foreach($products as $product)

                            <div class="col-md-3 col-12">
                              <div class="nk-gap-1"></div>
                            <div class="single-product-box">
        <div class="product-img">
                      @php 
                                        $photo=explode(',',$product->photo);
                                    @endphp
    <img src="{{ asset($photo[0]) }}" class="img-fluid">
       </div>
       <div class="info-area">
          
          
<a href="{{route('product-detail', $product->slug)}}"><h4 class="mb-5">{{$product->title}}</h4></a>
         
         
           <p>{{ Str::limit($product->summary,120) }}</p>
          <div class="nk-product-price mb-5" style="float:left;">
            {{ $product->getCurrencySymbol() }} {{number_format($product->price,2)}}</div>
         
         <form action="{{route('single-add-to-cart')}}" method="POST">
                                          @csrf
                                          <input type="hidden" name="quant[1]" class="qty-input"  data-min="1" data-max="1000" value="1" id="quantity">
                                          <input type="hidden" name="slug" value="{{$product->slug}}">
<button name='submit' class="nk-btn nk-btn-rounded nk-btn-color-main-1 w-50 float-right">Add to Cart</button>
                                    </form>
        </div>
      </div>
    </div>
@endforeach
                    @else
                        <h4 class="text-warning" style="margin:100px auto;">There are no products.</h4>
                    @endif 
                               </div>
                               <!-- end row section -->
                       
                             </div>
                           </div>             
                </div>
              
         
        </div>
        </div>
        </div>
    </div>
    <!-- end row section -->
   </div>
   <div class="nk-gap-3"></div>
</div>
<div class="nk-gap-4"></div>


@endsection