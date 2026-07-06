@extends('frontend.layouts.main')
@section('title', __('common.dashboard'))
@section('main-content')

<x-breadcrumb :title="__('common.my_account')" />

@php $u = Auth::user(); @endphp

<section class="dash-section">
    <div class="dash-container">
        <div class="dash-grid">

            {{-- ================= SIDEBAR ================= --}}
            <aside class="dash-side">
                <div class="dash-profile">
                    <span class="dash-avatar">{{ strtoupper(substr($u->name ?? 'U', 0, 1)) }}</span>
                    <div class="dash-profile__meta">
                        <span class="dash-profile__name">{{ $u->name }}</span>
                        <span class="dash-profile__email">{{ $u->email }}</span>
                    </div>
                </div>

                <div class="dash-stats">
                    <div class="dash-stat">
                        <span class="dash-stat__label">{{ __('common.available_points') }}</span>
                        <span class="dash-stat__value">{{ number_format($u->points_balance ?? 0) }} <small>{{ __('common.credits') }}</small></span>
                    </div>
                    <div class="dash-stat">
                        <span class="dash-stat__label">{{ __('common.artworks_enrolled') }}</span>
                        <span class="dash-stat__value">{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</span>
                    </div>
                    <div class="dash-stat">
                        <span class="dash-stat__label">{{ __('common.member_since') }}</span>
                        <span class="dash-stat__value">{{ $u->created_at->format('M Y') }}</span>
                    </div>
                </div>

                <nav class="dash-nav">
                    <button type="button" class="dash-nav__btn active" data-tab="purchased"><i class="fas fa-gift"></i> {{ __('common.points_purchased') }}</button>
                    <button type="button" class="dash-nav__btn" data-tab="redeemed"><i class="fas fa-palette"></i> {{ __('common.points_redeemed') }}</button>
                    <button type="button" class="dash-nav__btn" data-tab="password"><i class="fas fa-lock"></i> {{ __('common.change_password') }}</button>
                    <a href="{{ route('user.logout') }}" class="dash-nav__btn dash-nav__btn--logout"><i class="fas fa-sign-out-alt"></i> {{ __('common.logout') }}</a>
                </nav>
            </aside>

            {{-- ================= CONTENT ================= --}}
            <div class="dash-main">

                {{-- Purchases --}}
                <div class="dash-panel active" data-panel="purchased">
                    <div class="dash-card">
                        <h2 class="dash-h">{{ __('common.points_purchased_wallet') }}</h2>
                        @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                            <div class="dash-tablewrap">
                                <table class="dash-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.order_number') }}</th>
                                            <th>{{ __('common.points_bought') }}</th>
                                            <th>{{ __('common.price_paid') }}</th>
                                            <th>{{ __('common.payment_status') }}</th>
                                            <th>{{ __('common.date') }}</th>
                                            <th>{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchasedOrders as $order)
                                            <tr>
                                                <td class="is-strong">{{ $order->order_number }}</td>
                                                <td><span class="dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                                <td>{{ Helper::getCurrencySymbol($order->currency) }}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</td>
                                                <td>
                                                    @if($order->payment_status === 'Completed')
                                                        <span class="dash-tag dash-tag--ok">{{ __('common.paid') }}</span>
                                                    @elseif($order->payment_status === 'Failed')
                                                        <span class="dash-tag dash-tag--err">{{ __('common.failed') }}</span>
                                                    @else
                                                        <span class="dash-tag">{{ __('common.pending') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td><a href="{{ route('user.order.show', $order->id) }}" class="dash-view"><i class="fas fa-eye"></i> {{ __('common.view') }}</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="dash-empty"><i class="fas fa-inbox"></i><p>{{ __('common.no_past_orders') }}</p></div>
                        @endif
                    </div>
                </div>

                {{-- Redeemed --}}
                <div class="dash-panel" data-panel="redeemed">
                    <div class="dash-card">
                        <h2 class="dash-h">{{ __('common.points_redeemed_courses') }}</h2>
                        @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                            <div class="dash-tablewrap">
                                <table class="dash-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('common.order_number') }}</th>
                                            <th>{{ __('common.artwork_name') }}</th>
                                            <th>{{ __('common.level') }}</th>
                                            <th>{{ __('common.points_used') }}</th>
                                            <th>{{ __('common.status') }}</th>
                                            <th>{{ __('common.date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($redeemedOrders as $order)
                                            @php
                                                $cartItem = $order->cart_info->first();
                                                $level = null;
                                                if($cartItem) {
                                                    $level = \App\Models\ProductLevel::where('course_id', $cartItem->product_id)
                                                                                     ->where('price_in_points', $cartItem->points)
                                                                                     ->first();
                                                }
                                            @endphp
                                            <tr>
                                                <td class="is-strong">{{ $order->order_number }}</td>
                                                <td>{{ $cartItem && $cartItem->product ? $cartItem->product->title : 'N/A' }}</td>
                                                <td>
                                                    @if($level)<span class="dash-tag">{{ ucfirst($level->skill_level) }}</span>@else<span class="dash-tag dash-tag--muted">N/A</span>@endif
                                                </td>
                                                <td><span class="dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                                <td>
                                                    @if(strtolower($order->status) === 'completed')
                                                        <span class="dash-tag dash-tag--ok">{{ __('common.redeemed') }}</span>
                                                    @else
                                                        <span class="dash-tag">{{ $order->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="dash-empty"><i class="fas fa-palette"></i><p>{{ __('common.no_past_orders') }}</p></div>
                        @endif
                    </div>
                </div>

                {{-- Change password --}}
                <div class="dash-panel" data-panel="password">
                    <div class="dash-card">
                        <h2 class="dash-h">{{ __('common.change_password') }}</h2>
                        <form action="{{ route('change.password') }}" method="POST" class="dash-form">
                            @csrf
                            <div class="dash-field">
                                <label class="dash-label" for="current_password">{{ __('common.current_password') }}</label>
                                <input type="password" id="current_password" name="current_password" placeholder="{{ __('common.current_password_placeholder') }}" class="dash-input @error('current_password') is-invalid @enderror">
                                @error('current_password')<span class="dash-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="dash-field">
                                <label class="dash-label" for="new_password">{{ __('common.new_password') }}</label>
                                <input type="password" id="new_password" name="new_password" placeholder="{{ __('common.new_password_placeholder') }}" class="dash-input @error('new_password') is-invalid @enderror">
                                @error('new_password')<span class="dash-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="dash-field">
                                <label class="dash-label" for="new_confirm_password">{{ __('common.confirm_password') }}</label>
                                <input type="password" id="new_confirm_password" name="new_confirm_password" placeholder="{{ __('common.confirm_password_placeholder') }}" class="dash-input @error('new_confirm_password') is-invalid @enderror">
                                @error('new_confirm_password')<span class="dash-error">{{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="dash-submit"><i class="fas fa-check"></i> {{ __('common.update_password') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* =========================================================
       USER DASHBOARD — Structured theme (sidebar + tabs)
       ========================================================= */
    .dash-section { background-color: var(--color-putty, #c4c3b6); padding: 64px 40px; }
    .dash-container { max-width: 1160px; margin: 0 auto; }
    .dash-grid { display: grid; grid-template-columns: 320px 1fr; gap: 28px; align-items: start; }

    /* Sidebar */
    .dash-side { background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 14px; padding: 26px; position: sticky; top: 96px; }
    .dash-profile { display: flex; align-items: center; gap: 14px; padding-bottom: 22px; margin-bottom: 22px; border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .dash-avatar {
        width: 52px; height: 52px; flex-shrink: 0; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background-color: var(--color-ink, #000); color: var(--color-paper, #fff);
        font-family: var(--font-davinci, serif); font-size: 22px; font-weight: 500;
    }
    .dash-profile__meta { min-width: 0; }
    .dash-profile__name { display: block; font-family: var(--font-davinci, serif); font-size: 17px; font-weight: 500; color: var(--color-ink, #000); line-height: 1.2; word-break: break-word; }
    .dash-profile__email { display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; color: var(--color-graphite, #595855); margin-top: 3px; word-break: break-word; }

    .dash-stats { display: flex; flex-direction: column; gap: 10px; padding-bottom: 22px; margin-bottom: 22px; border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .dash-stat { display: flex; align-items: baseline; justify-content: space-between; gap: 10px; }
    .dash-stat__label { font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: var(--color-graphite, #595855); }
    .dash-stat__value { font-family: var(--font-davinci, serif); font-size: 18px; font-weight: 500; color: var(--color-ink, #000); }
    .dash-stat__value small { font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; color: var(--color-graphite, #595855); }

    .dash-nav { display: flex; flex-direction: column; gap: 4px; }
    .dash-nav__btn {
        display: flex; align-items: center; gap: 12px; width: 100%; text-align: left;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13.5px; font-weight: 600;
        color: var(--color-ink, #000); background: transparent; border: none; border-radius: 9px;
        padding: 12px 14px; cursor: pointer; text-decoration: none; transition: background-color 0.2s ease, color 0.2s ease;
    }
    .dash-nav__btn i { width: 16px; font-size: 13px; color: var(--color-graphite, #595855); }
    .dash-nav__btn:hover { background-color: var(--color-bone, #e7e5e4); }
    .dash-nav__btn.active { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); }
    .dash-nav__btn.active i { color: var(--color-paper, #fff); }
    .dash-nav__btn--logout { margin-top: 8px; border-top: 1px solid var(--color-vellum, #dfdcd5); border-radius: 0 0 9px 9px; padding-top: 16px; }

    /* Content */
    .dash-main { min-width: 0; }
    .dash-panel { display: none; }
    .dash-panel.active { display: block; animation: dash-fade 0.3s ease both; }
    @keyframes dash-fade { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    .dash-card { background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 14px; padding: 32px; }
    .dash-h { font-family: var(--font-davinci, serif); font-size: 24px; font-weight: 500; color: var(--color-ink, #000); margin: 0 0 24px 0; }

    /* Table */
    .dash-tablewrap { overflow-x: auto; }
    .dash-table { width: 100%; border-collapse: collapse; font-family: var(--font-helvetica-now, sans-serif); }
    .dash-table th { text-align: left; font-size: 10.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-graphite, #595855); padding: 0 14px 12px 14px; border-bottom: 1px solid var(--color-vellum, #dfdcd5); white-space: nowrap; }
    .dash-table td { font-size: 13.5px; color: var(--color-ink, #000); padding: 14px; border-bottom: 1px solid var(--color-vellum, #dfdcd5); white-space: nowrap; }
    .dash-table tbody tr:last-child td { border-bottom: none; }
    .dash-table tbody tr:hover td { background-color: var(--color-bone, #e7e5e4); }
    .dash-table .is-strong { font-weight: 600; }

    .dash-pill { display: inline-flex; align-items: center; gap: 6px; background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-radius: 28.8px; padding: 4px 12px; font-size: 12px; font-weight: 600; }
    .dash-pill i { font-size: 10px; }
    .dash-tag { display: inline-block; background-color: var(--color-bone, #e7e5e4); color: var(--color-ink, #000); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 28.8px; padding: 3px 11px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; }
    .dash-tag--ok { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); }
    .dash-tag--err { background-color: transparent; color: var(--color-ink, #000); }
    .dash-tag--muted { color: var(--color-graphite, #595855); }
    .dash-view { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; color: var(--color-ink, #000); text-decoration: none; border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 28.8px; padding: 6px 14px; transition: all 0.2s ease; }
    .dash-view:hover { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); }

    .dash-empty { text-align: center; padding: 56px 20px; }
    .dash-empty i { font-size: 42px; color: var(--color-graphite, #595855); opacity: 0.35; margin-bottom: 16px; }
    .dash-empty p { font-family: var(--font-davinci, serif); font-size: 18px; color: var(--color-ink, #000); margin: 0; }

    /* Change password form */
    .dash-field { margin-bottom: 18px; }
    .dash-label { display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: var(--color-graphite, #595855); margin-bottom: 8px; }
    .dash-input {
        width: 100%; box-sizing: border-box;
        background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 9px;
        padding: 12px 14px; font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-ink, #000);
        outline: none; transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .dash-input:focus { border-color: var(--color-ink, #000); box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.08); background-color: var(--color-paper, #fff); }
    .dash-input.is-invalid { border-color: #cf7d7d; box-shadow: 0 0 0 3px rgba(207, 125, 125, 0.18); }
    .dash-error { display: block; margin-top: 7px; font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; color: #c0392b; font-weight: 500; }
    .dash-submit {
        width: 100%; margin-top: 6px; display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border: 1px solid var(--color-ink, #000);
        border-radius: 28.8px; padding: 14px; cursor: pointer; transition: opacity 0.2s ease;
    }
    .dash-submit:hover { opacity: 0.85; }

    @media (max-width: 900px) {
        .dash-section { padding: 40px 20px; }
        .dash-grid { grid-template-columns: 1fr; gap: 20px; }
        .dash-side { position: static; }
        .dash-nav { flex-direction: row; flex-wrap: wrap; }
        .dash-nav__btn { width: auto; flex: 1 1 auto; justify-content: center; }
        .dash-nav__btn--logout { border-top: none; padding-top: 12px; border-radius: 9px; }
    }
</style>
@endpush

@push('scripts')
<script>
    (function () {
        var btns = document.querySelectorAll('.dash-nav__btn[data-tab]');
        var panels = document.querySelectorAll('.dash-panel');
        btns.forEach(function (b) {
            b.addEventListener('click', function () {
                var t = this.getAttribute('data-tab');
                btns.forEach(function (x) { x.classList.remove('active'); });
                panels.forEach(function (p) { p.classList.remove('active'); });
                this.classList.add('active');
                var panel = document.querySelector('.dash-panel[data-panel="' + t + '"]');
                if (panel) panel.classList.add('active');
            });
        });
        // If there are validation errors on the password form, open that tab
        @if($errors->any())
            var passTab = document.querySelector('.dash-nav__btn[data-tab="password"]');
            if (passTab) passTab.click();
        @endif
    })();
</script>
@endpush
