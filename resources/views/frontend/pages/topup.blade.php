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
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'min' => 1,      'r' => '&yen;1 - &yen;79,999'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 80000,  'r' => '&yen;80,000 - &yen;159,999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 160000, 'r' => '&yen;160,000 - &yen;239,999'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 240000, 'r' => '&yen;240,000+'],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
        $rateNote = __('frontend.topup.rate_jpy');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'min' => 1,     'r' => 'HK$1 - HK$3,999'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 4000,  'r' => 'HK$4,000 - HK$7,999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 8000,  'r' => 'HK$8,000 - HK$11,999'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 12000, 'r' => 'HK$12,000+'],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rateNote = __('frontend.topup.rate_hkd');
    } else {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'min' => 1,    'r' => '$1 - $499'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 500,  'r' => '$500 - $999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 1000, 'r' => '$1,000 - $1,499'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 1500, 'r' => '$1,500+'],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rateNote = __('frontend.topup.rate_usd');
    }
@endphp

<section class="credit">
    <div class="credit__wrap">
        <header class="credit__intro">
            <p class="credit__eyebrow"><i class="fas fa-coins" aria-hidden="true"></i>{{ __('frontend.header.credits') }}</p>
            <h2 class="credit__title">{{ __('frontend.topup.heading') }}</h2>
            <p class="credit__lead">{{ __('frontend.topup.lead') }}</p>
        </header>

        <ul class="spec">
            <li class="spec__cell">
                <span class="spec__icon" aria-hidden="true"><i class="fas fa-exchange-alt"></i></span>
                <span class="spec__text">
                    <small>{{ __('frontend.topup.rate_label') }}</small>
                    <strong>{{ $rateNote }}</strong>
                </span>
            </li>
            <li class="spec__cell">
                <span class="spec__icon" aria-hidden="true"><i class="far fa-calendar-check"></i></span>
                <span class="spec__text">
                    <small>{{ __('frontend.topup.validity_label') }}</small>
                    <strong>{{ rtrim(__('frontend.topup.validity'), '.。') }}</strong>
                </span>
            </li>
            <li class="spec__cell">
                <span class="spec__icon" aria-hidden="true"><i class="fas fa-unlock-alt"></i></span>
                <span class="spec__text">
                    <small>{{ __('frontend.topup.use_label') }}</small>
                    <strong>{{ rtrim(__('frontend.topup.use'), '.。') }}</strong>
                </span>
            </li>
        </ul>

        <form action="{{ route('points.add-to-cart') }}" method="POST" class="credit__grid" data-credit-form novalidate>
            @csrf

            <div class="credit__main">
                <div class="ladder">
                    <div class="ladder__head">
                        <h3 class="ladder__title">{{ __('frontend.topup.tiers_title') }}</h3>
                        <p class="ladder__text">{{ __('frontend.topup.tiers_text') }}</p>
                    </div>
                    <table class="ladder__table">
                        <caption class="vh">{{ __('frontend.topup.tiers_title') }}</caption>
                        <thead>
                            <tr>
                                <th scope="col">{{ __('frontend.topup.tier') }}</th>
                                <th scope="col">{{ __('frontend.topup.range') }}</th>
                                <th scope="col">{{ __('frontend.topup.multiplier') }}</th>
                                <th scope="col"><span class="vh">{{ __('frontend.topup.status') }}</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tiers as $t)
                                <tr class="rung {{ $loop->last ? 'rung--top' : '' }}" data-mult="{{ $t['big'] }}" data-min="{{ $t['min'] }}" data-name="{{ $t['n'] }}" style="--fill: {{ ($loop->index + 1) * 25 }}%">
                                    <th scope="row" data-label="{{ __('frontend.topup.tier') }}">
                                        <span class="rung__name">
                                            <span class="rung__icon" aria-hidden="true"><i class="fas {{ $t['i'] }}"></i></span>
                                            {{ $t['n'] }}
                                        </span>
                                    </th>
                                    <td class="rung__range" data-label="{{ __('frontend.topup.range') }}">{!! $t['r'] !!}</td>
                                    <td data-label="{{ __('frontend.topup.multiplier') }}">
                                        <span class="rung__mult">
                                            <strong>{{ $t['big'] }}</strong>
                                            <span class="rung__meter" aria-hidden="true"><span></span></span>
                                        </span>
                                    </td>
                                    <td class="rung__state">
                                        @if($loop->last)
                                            <span class="rung__best">{{ __('frontend.topup.top_tier') }}</span>
                                        @endif
                                        <span class="rung__match"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.topup.your_tier') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="console">
                    <div class="console__head">
                        <p class="console__kicker">{{ __('frontend.topup.calc_step') }}</p>
                        <h3 class="console__title">{{ __('frontend.topup.calc_title') }}</h3>
                        <p class="console__text">{{ __('frontend.topup.calc_text') }}</p>
                    </div>

                    <label class="console__label" for="topup_amount">{{ __('frontend.topup.amount') }}</label>
                    <div class="display">
                        <span class="display__sym" aria-hidden="true">{!! $symbol !!}</span>
                        <input type="number" name="amount" id="topup_amount" class="display__input" placeholder="{{ __('frontend.topup.amount_placeholder') }}" min="1" required inputmode="decimal">
                        <span class="display__mult" data-live-mult aria-hidden="true">x1</span>
                    </div>

                    <span class="console__label" id="keysLabel">{{ __('frontend.topup.presets') }}</span>
                    <div class="keys" role="group" aria-labelledby="keysLabel">
                        @foreach($quick as $q)
                            <button type="button" class="key" data-amount="{{ $q }}">
                                <span class="key__amount">{!! $symbol !!}{{ number_format($q) }}</span>
                                <span class="key__mult">{{ $tiers[$loop->index]['big'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <p class="status" aria-live="polite" data-hint>
                        <span class="status__icon" aria-hidden="true"><i class="far fa-lightbulb"></i></span>
                        <span data-hint-text>{{ __('frontend.topup.tip_start') }}</span>
                    </p>
                </div>
            </div>

            <aside class="receipt-wrap">
                <div class="receipt">
                    <p class="receipt__label">{{ __('frontend.topup.you_get') }}</p>
                    <p class="receipt__total" id="tpTotalWrap" aria-live="polite">
                        <strong id="total_points">0</strong>
                        <span>{{ __('frontend.topup.credits') }}</span>
                    </p>

                    <table class="receipt__lines">
                        <caption class="vh">{{ __('frontend.topup.breakdown') }}</caption>
                        <tbody>
                            <tr>
                                <th scope="row"><span>{{ __('frontend.topup.row_amount') }}</span></th>
                                <td id="amount_display">{!! $symbol !!}0</td>
                            </tr>
                            <tr>
                                <th scope="row"><span>{{ __('frontend.topup.row_base') }}</span></th>
                                <td id="base_points">0</td>
                            </tr>
                            <tr>
                                <th scope="row"><span>{{ __('frontend.topup.row_multiplier') }}</span></th>
                                <td id="multiplier_display">x1</td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn--block receipt__submit">
                        <span>{{ __('frontend.topup.add') }}</span>
                        <i class="fas fa-cart-plus" aria-hidden="true"></i>
                    </button>

                    <p class="receipt__secure">
                        <i class="fas fa-lock" aria-hidden="true"></i>
                        <span>{{ __('frontend.topup.secure') }}</span>
                    </p>
                </div>
            </aside>
        </form>
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
    const tiers = Array.prototype.slice.call(document.querySelectorAll('.rung'));
    const keys = document.querySelectorAll('.key');
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
            const btn = form.querySelector('.receipt__submit');
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
