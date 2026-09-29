@extends('frontend.layouts.main')
@section('title', __('frontend.topup.title'))
@section('description', __('frontend.topup.description'))

@section('main-content')
@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.topup.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.topup.title')]
    ]
])

@php
    $cur = session('currency');
    if ($cur == 'JPY') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-seedling', 'big' => 'x1',   'min' => 1,      'r' => '&yen;1 - &yen;79,999'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 80000,  'r' => '&yen;80,000 - &yen;159,999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 160000, 'r' => '&yen;160,000 - &yen;239,999'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 240000, 'r' => '&yen;240,000+'],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
        $rateNote = __('frontend.topup.rate_jpy');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-seedling', 'big' => 'x1',   'min' => 1,     'r' => 'HK$1 - HK$3,999'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 4000,  'r' => 'HK$4,000 - HK$7,999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 8000,  'r' => 'HK$8,000 - HK$11,999'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 12000, 'r' => 'HK$12,000+'],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rateNote = __('frontend.topup.rate_hkd');
    } else {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-seedling', 'big' => 'x1',   'min' => 1,    'r' => '$1 - $499'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 500,  'r' => '$500 - $999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 1000, 'r' => '$1,000 - $1,499'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 1500, 'r' => '$1,500+'],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rateNote = __('frontend.topup.rate_usd');
    }
@endphp

<section class="pay">
    <div class="container tu">
        <div class="tu-tiers">
            <div class="tu-tiers__head">
                <h2 class="tu__title">{{ __('frontend.topup.tiers_title') }}</h2>
                <p class="tu__text">{{ __('frontend.topup.tiers_text') }}</p>
            </div>

            <div class="tu-grid">
                @foreach($tiers as $t)
                    <article class="tu-row" data-mult="{{ $t['big'] }}" data-min="{{ $t['min'] }}" data-name="{{ $t['n'] }}">
                        <div class="tu-row__top">
                            <span class="tu-row__icon" aria-hidden="true"><i class="fas {{ $t['i'] }}"></i></span>
                            <span class="tu-row__match">{{ __('frontend.topup.your_tier') }}</span>
                            @if($loop->last)
                                <span class="tu-row__best">{{ __('frontend.topup.top_tier') }}</span>
                            @endif
                        </div>
                        <h3 class="tu-row__name">{{ $t['n'] }}</h3>
                        <p class="tu-row__range">{!! $t['r'] !!}</p>
                        <p class="tu-row__mult"><strong>{{ $t['big'] }}</strong> <span>{{ __('frontend.topup.multiplier') }}</span></p>
                    </article>
                @endforeach
            </div>

            <ul class="tu-notes">
                <li class="tu-notes__item">
                    <span class="tu-notes__icon" aria-hidden="true"><i class="fas fa-exchange-alt"></i></span>
                    <span class="tu-notes__text">
                        <small>{{ __('frontend.topup.rate_label') }}</small>
                        <strong>{{ $rateNote }}</strong>
                    </span>
                </li>
                <li class="tu-notes__item">
                    <span class="tu-notes__icon" aria-hidden="true"><i class="far fa-calendar-check"></i></span>
                    <span class="tu-notes__text">
                        <small>{{ __('frontend.topup.validity_label') }}</small>
                        <strong>{{ rtrim(__('frontend.topup.validity'), '.。') }}</strong>
                    </span>
                </li>
                <li class="tu-notes__item">
                    <span class="tu-notes__icon" aria-hidden="true"><i class="fas fa-unlock-alt"></i></span>
                    <span class="tu-notes__text">
                        <small>{{ __('frontend.topup.use_label') }}</small>
                        <strong>{{ rtrim(__('frontend.topup.use'), '.。') }}</strong>
                    </span>
                </li>
            </ul>
        </div>

        <form action="{{ route('points.add-to-cart') }}" method="POST" class="tu-calc" data-credit-form novalidate>
            @csrf

            <div class="tu-calc__main">
                <h2 class="tu__title">{{ __('frontend.topup.calc_title') }}</h2>

                <label class="tu-calc__label" for="topup_amount">{{ __('frontend.topup.amount') }}</label>
                <div class="tu-input">
                    <span class="tu-input__sym" aria-hidden="true">{!! $symbol !!}</span>
                    <input type="number" name="amount" id="topup_amount" placeholder="{{ __('frontend.topup.amount_placeholder') }}" min="1" required inputmode="decimal">
                    <span class="tu-input__mult" data-live-mult aria-hidden="true">x1</span>
                </div>

                <span class="tu-calc__label" id="keysLabel">{{ __('frontend.topup.presets') }}</span>
                <div class="tu-keys" role="group" aria-labelledby="keysLabel">
                    @foreach($quick as $q)
                        <button type="button" class="tu-key" data-amount="{{ $q }}">
                            <span>{!! $symbol !!}{{ number_format($q) }}</span>
                            <small>{{ $tiers[$loop->index]['big'] }}</small>
                        </button>
                    @endforeach
                </div>

                <p class="tu-hint" aria-live="polite" data-hint>
                    <i class="far fa-lightbulb" aria-hidden="true"></i>
                    <span data-hint-text>{{ __('frontend.topup.tip_start') }}</span>
                </p>
            </div>

            <div class="tu-calc__out">
                <p class="tu-result__label">{{ __('frontend.topup.you_get') }}</p>
                <p class="tu-result__total" id="tpTotalWrap" aria-live="polite">
                    <strong id="total_points">0</strong>
                    <span>{{ __('frontend.topup.credits') }}</span>
                </p>
                <dl class="tu-result__lines" aria-label="{{ __('frontend.topup.breakdown') }}">
                    <div><dt>{{ __('frontend.topup.row_amount') }}</dt><dd id="amount_display">{!! $symbol !!}0</dd></div>
                    <div><dt>{{ __('frontend.topup.row_base') }}</dt><dd id="base_points">0</dd></div>
                    <div><dt>{{ __('frontend.topup.row_multiplier') }}</dt><dd id="multiplier_display">x1</dd></div>
                </dl>

                <button type="submit" class="btn btn--primary btn--block tu-calc__submit">
                    <i class="fas fa-cart-plus" aria-hidden="true"></i>
                    <span>{{ __('frontend.topup.add') }}</span>
                </button>

                <p class="tu-calc__secure">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <span>{{ __('frontend.topup.secure') }}</span>
                </p>
            </div>
        </form>

        <div class="tu-how">
            <h2 class="tu__title">{{ __('frontend.topup.how_title') }}</h2>
            <ol class="tu-how__list">
                @foreach([1, 2, 3, 4] as $step)
                    <li class="tu-how__step" style="--i: {{ $loop->index }}">
                        <span class="tu-how__no" aria-hidden="true">{{ str_pad($step, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="tu-how__name">{{ __('frontend.topup.how_' . $step . '_title') }}</h3>
                        <p class="tu-how__text">{{ __('frontend.topup.how_' . $step . '_text') }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('topup_amount');
    const totalOut = document.getElementById('total_points');
    const baseOut = document.getElementById('base_points');
    const multOut = document.getElementById('multiplier_display');
    const amountOut = document.getElementById('amount_display');
    const totalWrap = document.getElementById('tpTotalWrap');
    const liveMult = document.querySelector('[data-live-mult]');
    const tiers = Array.prototype.slice.call(document.querySelectorAll('.tu-row'));
    const keys = document.querySelectorAll('.tu-key');
    const hint = document.querySelector('[data-hint]');
    const hintText = document.querySelector('[data-hint-text]');
    const symbol = @json(html_entity_decode($symbol));
    const words = {
        start: @json(__('frontend.topup.tip_start')),
        next: @json(__('frontend.topup.tip_next')),
        top: @json(__('frontend.topup.tip_top'))
    };
    const isJPY = {{ session('currency') == 'JPY' ? 'true' : 'false' }};
    const isHKD = {{ session('currency') == 'HKD' ? 'true' : 'false' }};
    if (!input) return;

    const mins = tiers.map(function (tier) { return parseFloat(tier.dataset.min); });

    function calculate() {
        const amount = parseFloat(input.value) || 0;
        const usd = isJPY ? amount / 160 : (isHKD ? amount / 8 : amount);
        let multiplier = 1;
        if (usd >= 1500) multiplier = 3;
        else if (usd >= 1000) multiplier = 2.5;
        else if (usd >= 500) multiplier = 2;

        const base = Math.round(usd);
        const total = Math.round(usd * multiplier);
        const mult = 'x' + multiplier;
        baseOut.textContent = base.toLocaleString();
        multOut.textContent = mult;
        if (liveMult) { liveMult.textContent = mult; liveMult.classList.toggle('is-up', multiplier > 1); }
        totalOut.textContent = total.toLocaleString();
        amountOut.textContent = symbol + amount.toLocaleString();

        let current = -1;
        tiers.forEach(function (tier, i) {
            const reached = amount > 0 && amount >= mins[i];
            tier.classList.toggle('is-reached', reached);
            if (reached) current = i;
        });
        tiers.forEach(function (tier, i) {
            tier.classList.toggle('is-match', i === current);
        });

        if (amount <= 0) {
            hintText.textContent = words.start;
            hint.classList.remove('is-top');
        } else if (current >= tiers.length - 1) {
            hintText.textContent = words.top;
            hint.classList.add('is-top');
        } else {
            const next = tiers[current + 1];
            const gap = Math.max(mins[current + 1] - amount, 0);
            hintText.textContent = words.next
                .replace(':amount', symbol + gap.toLocaleString())
                .replace(':tier', next.dataset.name)
                .replace(':mult', next.dataset.mult);
            hint.classList.remove('is-top');
        }

        keys.forEach(function (key) {
            key.classList.toggle('is-active', key.dataset.amount === input.value);
        });
        totalWrap.classList.remove('is-tick');
        void totalWrap.offsetWidth;
        totalWrap.classList.add('is-tick');
    }

    input.addEventListener('input', function () {
        this.setCustomValidity('');
        calculate();
    });
    input.addEventListener('change', calculate);

    keys.forEach(function (key) {
        key.addEventListener('click', function () {
            input.value = key.dataset.amount;
            input.dispatchEvent(new Event('input', { bubbles: true }));
            input.focus();
        });
    });

    document.querySelectorAll('[data-credit-form]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!((parseFloat(input.value) || 0) >= 1)) {
                input.setCustomValidity(@json(__('frontend.topup.amount_required')));
                input.reportValidity();
                return;
            }
            const btn = form.querySelector('.tu-calc__submit');
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> <span>' + @json(__('frontend.topup.adding')) + '</span>';

            fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                .then(function (response) { return new Promise(function (resolve) { setTimeout(function () { resolve(response); }, 500); }); })
                .then(function () { window.location.reload(); })
                .catch(function () {
                    btn.disabled = false;
                    btn.innerHTML = original;
                });
        });
    });
});
</script>
@endpush
