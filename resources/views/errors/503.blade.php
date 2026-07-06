@extends('frontend.layouts.main')
@section('main-content')
<style>
      #notfound {
  position: relative;
  height: 100vh;
}
.page_weror
{
  padding:80px 0px;
  background-color:#f9f4f1;
}
 
#notfound .notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}
p.nfound_cntnt
{
  font-size: 23px;
    line-height: 36px;
       margin-bottom: 40px;
}
 
.notfound {
  max-width: 490px;
  width: 100%;
  text-align: center;  
}
 
.notfound .notfound-404 {
  height: 200px;
  position: relative;
  z-index: -1;
}
 
.notfound .notfound-404 h1 {
 font-size: 150px;
  margin: 0px;
  font-weight: 900;
  position: absolute;
  left: 50%;
  -webkit-transform: translateX(-50%);
      -ms-transform: translateX(-50%);
          transform: translateX(-50%);
   -webkit-background-clip: text;
  -webkit-text-fill-color: #335371;
  background-size: cover;
  background-position: center;
  white-space:nowrap;
}
@media (max-width:768px)
{
    .notfound
    {
max-width:100%;
    }
    .notfound .notfound-404 h1
    {
        font-size:100px;
    }
    .notfound .notfound-404
    {
        height:180px;
    }
}
 
 
    </style>
    <section class="page_weror">
     <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1> {{ __('common.oops') }} </h1>
            </div>
          <p class="nfound_cntnt">{{ __('common.this_link_does_not') }}<br>
            {{ __('common.please_go') }}</p>
            <a href="{{ route('home') }}" class="theme-btn btn-style-one">{{ __('common.go_to_homepage') }}</a>
        </div>
    </div>
</section>
@endsection