@extends('frontend.layouts.main')
@section('main-content')
<div class="nk-gap-1"></div>
<div class="breadcr-info">
   <div class="container">
                <ul class="nk-breadcrumbs">
                    <li><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li><a href="">FAQs</a></li>                  
                </ul>
            </div>
 </div>

<!-- end breadcrumb section -->


          <section class="faq-cntnt" data-aos="fade-up" style="background-image: none;">
  
      <div class="container">
         <h2> Frequently Asked Questions (FAQs) </h2>
         <div id="accordion">
            <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4">
                     <a class="card-link accordion-title" data-toggle="collapse" href="#collapseOne">
                     1. What is game boosting and how does it work?
                     </a>
                  </h2>
               </div>
               <div id="collapseOne" class="collapse show" data-parent="#accordion">
                  <div class="card-body">
                     <p>Game boosting is a service where experienced players help you improve your in-game progress such as leveling up, ranking higher, or earning rewards faster. You purchase a service, and our pros either play on your account or coach you to achieve the desired result safely and efficiently.</p>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseTwo">
                    2. Is my account safe during boosting?
                     </a>
                  </h2>
               </div>
               <div id="collapseTwo" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>Yes! We prioritize your account’s security with strict confidentiality and advanced security protocols. Our boosters follow fair play policies, and your login information is never shared or misused.</p>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseThree">
                  3. How long does the boosting process take?
                     </a>
                  </h2>
               </div>
               <div id="collapseThree" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>The duration depends on the specific service and your current progress. Leveling might take a few hours to days, while rank boosting or placement match boosts vary based on the skill required. We always aim to complete services as quickly as possible without compromising quality.</p>
                  </div>
               </div>
            </div>
             <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseFour">
                  4. Can I play on my account while boosting is in progress?
                     </a>
                  </h2>
               </div>
               <div id="collapseFour" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>We recommend avoiding playing on your account during active boosting to prevent conflicts or progress loss. For coaching services, you will be actively involved to improve your skills.</p>
                  </div>
               </div>
            </div>
             <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseFive">
                 5. What games do you offer boosting for?
                     </a>
                  </h2>
               </div>
               <div id="collapseFive" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>We provide boosting services for a variety of popular competitive games such as Dominion Rift, DriftHack Underground, CyberKnights Legacy, and many more. Check our product list for the full range.</p>
                  </div>
               </div>
            </div>
             <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseSix">
                  6. Are your boosting services legal and allowed by the games?
                     </a>
                  </h2>
               </div>
               <div id="collapseSix" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>Our services comply with most game policies by focusing on skill improvement and account progression without cheating or using unauthorized software. However, it’s always best to check the specific game’s terms of service.</p>
                  </div>
               </div>
            </div>
             <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseSeven">
                  7. How do I get started with a boosting service?
                     </a>
                  </h2>
               </div>
               <div id="collapseSeven" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>Simply select the desired boosting package from our website, provide your account details securely, and complete the payment. Our team will then begin the process and update you regularly.</p>
                  </div>
               </div>
            </div>
             <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseEight">
                  8. What payment methods do you accept?
                     </a>
                  </h2>
               </div>
               <div id="collapseEight" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>We accept various secure payment options, including credit/debit cards, PayPal, and other popular payment gateways. All transactions are encrypted for your safety.</p>
                  </div>
               </div>
            </div>
             <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseNine">
                  9. What if I am not satisfied with the service?</a>
                  </h2>
               </div>
               <div id="collapseNine" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>Customer satisfaction is our priority. If you have any issues or concerns, contact our support team immediately. We offer revisions, refunds, or custom solutions depending on the case.</p>
                  </div>
               </div>
            </div>
             <div class="card">
               <div class="card-header">
                  <h2 class="nk-post-title h4"> 
                     <a class="collapsed card-link accordion-title" data-toggle="collapse" href="#collapseTen">
                  10. Do you offer coaching or gameplay analysis?
                     </a>
                  </h2>
               </div>
               <div id="collapseTen" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                     <p>Yes! We provide personalized coaching and gameplay analysis services to help you improve your skills, game strategies, and overall performance.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
  
</section>

 
<div class="nk-gap-3"></div>

@endsection