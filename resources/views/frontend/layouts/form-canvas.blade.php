{{-- ==========================================================================
     Form canvas
     The drawn background behind every form card — aurora mesh, study dots,
     orbit rings and floating course marks. No imagery, purely decorative.
     Shared by login, register, forgot password and contact.
     Styles: public/css/theme.css — section 17

     Usage:  @include('frontend.layouts.form-canvas')
     ========================================================================== --}}
<span class="fm__fx" aria-hidden="true">
    <span class="fm__aurora fm__aurora--iris"></span>
    <span class="fm__aurora fm__aurora--orchid"></span>
    <span class="fm__aurora fm__aurora--cobalt"></span>

    <span class="fm__dots"></span>

    <span class="fm__orbit fm__orbit--outer"><span class="fm__orbit-dot"></span></span>
    <span class="fm__orbit fm__orbit--inner"><span class="fm__orbit-dot"></span></span>

    <span class="fm__mark fm__mark--1"><i class="fas fa-graduation-cap"></i></span>
    <span class="fm__mark fm__mark--orchid fm__mark--2"><i class="fas fa-book-open"></i></span>
    <span class="fm__mark fm__mark--3"><i class="fas fa-play"></i></span>
    <span class="fm__mark fm__mark--orchid fm__mark--4"><i class="fas fa-award"></i></span>
</span>
