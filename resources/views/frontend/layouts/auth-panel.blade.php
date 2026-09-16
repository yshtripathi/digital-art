{{-- ==========================================================================
     Auth side panel
     Photograph with the page's own reassurance copy over it. Shared by login,
     register and forgot-password. Styles: public/css/app.css — section 10

     Usage:
     @include('frontend.layouts.auth-panel', [
         'kicker' => __('frontend.login.label'),   // short headline
         'copy'   => __('frontend.login.aside'),   // one sentence of context
     ])
     ========================================================================== --}}
<aside class="au-panel">
    <img
        class="au-panel__img"
        src="{{ asset('assets/images/auth-panel.webp') }}"
        srcset="{{ asset('assets/images/auth-panel-sm.webp') }} 540w, {{ asset('assets/images/auth-panel.webp') }} 960w"
        sizes="(max-width: 63.99rem) 0px, 30vw"
        width="960" height="1440"
        alt=""
        loading="lazy"
        decoding="async">

    <div class="au-panel__text">
        <p class="au-panel__kicker">{{ $kicker }}</p>
        <p class="au-panel__copy">{{ $copy }}</p>
    </div>
</aside>
