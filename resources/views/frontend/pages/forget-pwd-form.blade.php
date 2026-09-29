@extends('frontend.layouts.main')
@section('title', __('frontend.forgot.tab'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.forgot.tab'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.forgot.tab')]
    ]
])

<section class="gate">
    <div class="gate__stack">
        <div class="gate__card">
            <div class="gate__head">
                <span class="gate__badge" aria-hidden="true"><i class="fas fa-unlock-alt"></i></span>
                <div>
                    <h2 class="gate__title">{{ __('frontend.forgot.heading') }}</h2>
                    <p class="gate__lead">{{ __('frontend.forgot.text') }}</p>
                </div>
            </div>

            @if(session('status'))
                <p class="gate__note gate__note--ok" role="status">
                    <i class="fas fa-check" aria-hidden="true"></i>
                    <span>{{ __('frontend.forgot.sent') }}</span>
                </p>
            @endif

            <form name="frmForgot" id="frmForgot" class="gate__form" action="{{ route('password.email') }}" method="post" novalidate>
                @csrf

                <div class="entry">
                    <label class="entry__label" for="email">{{ __('frontend.forgot.email') }}</label>
                    <div class="entry__box @error('email') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-at"></i></span>
                        <input type="email" name="email" id="email" autocomplete="email" class="entry__input" placeholder="{{ __('frontend.forgot.email_placeholder') }}" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="entry">
                        <label class="entry__label" for="captcha">{{ __('frontend.forgot.captcha') }}</label>
                        <div class="entry__cap">
                            <div class="cap__img">@captcha</div>
                            <div class="entry__box @error('captcha') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-shield-alt"></i></span>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="entry__input" placeholder="{{ __('frontend.forgot.captcha_placeholder') }}">
                            </div>
                        </div>
                        @error('captcha')
                            <span class="entry__err">{{ __('frontend.forgot.captcha_invalid') }}</span>
                        @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="btn btn--block gate__submit">
                    <span>{{ __('frontend.forgot.button') }}</span>
                    <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="gate__foot">
                {{ __('frontend.forgot.remembered') }}
                <a href="{{ route('login.form') }}" class="gate__swap">{{ __('frontend.forgot.login_link') }}</a>
            </p>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmForgot").validate({
            errorElement: 'span',
            errorClass: 'entry__err',
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('.entry'));
            },
            highlight: function(element) {
                $(element).closest('.entry__box').addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).closest('.entry__box').removeClass('is-invalid');
            },
            rules: {
                email: { required: true, email: true },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                email: {
                    required: @json(__('frontend.forgot.email_required')),
                    email: @json(__('frontend.forgot.email_invalid'))
                },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: @json(__('frontend.forgot.captcha_required'))
                @endif
            }
        });
    });
</script>
@endpush
