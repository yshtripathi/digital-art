@extends('frontend.layouts.main')
@section('title', __('inkwave.dash_title'))
@section('main-content')

<x-breadcrumb :title="__('inkwave.dash_my_account')" />

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
                        <span class="dash-stat__label">{{ __('inkwave.dash_available_points') }}</span>
                        <span class="dash-stat__value">{{ number_format($u->points_balance ?? 0) }} <small>{{ __('inkwave.pd_credits') }}</small></span>
                    </div>
                    <div class="dash-stat">
                        <span class="dash-stat__label">{{ __('inkwave.dash_artworks_enrolled') }}</span>
                        <span class="dash-stat__value">{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</span>
                    </div>
                    <div class="dash-stat">
                        <span class="dash-stat__label">{{ __('inkwave.dash_member_since') }}</span>
                        <span class="dash-stat__value">{{ $u->created_at->format('M Y') }}</span>
                    </div>
                </div>

                <nav class="dash-nav">
                    <button type="button" class="dash-nav__btn active" data-tab="purchased"><i class="fas fa-gift"></i> {{ __('inkwave.dash_points_purchased') }}</button>
                    <button type="button" class="dash-nav__btn" data-tab="redeemed"><i class="fas fa-palette"></i> {{ __('inkwave.dash_points_redeemed') }}</button>
                    <button type="button" class="dash-nav__btn" data-tab="password"><i class="fas fa-lock"></i> {{ __('inkwave.dash_change_password') }}</button>
                    <a href="{{ route('user.logout') }}" class="dash-nav__btn dash-nav__btn--logout"><i class="fas fa-sign-out-alt"></i> {{ __('inkwave.dash_logout') }}</a>
                </nav>
            </aside>

            {{-- ================= CONTENT ================= --}}
            <div class="dash-main">

                {{-- Purchases --}}
                <div class="dash-panel active" data-panel="purchased">
                    <div class="dash-card">
                        <h2 class="dash-h">{{ __('inkwave.dash_points_purchased_wallet') }}</h2>
                        @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                            <div class="dash-tablewrap">
                                <table class="dash-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('inkwave.dash_order_number') }}</th>
                                            <th>{{ __('inkwave.dash_points_bought') }}</th>
                                            <th>{{ __('inkwave.dash_price_paid') }}</th>
                                            <th>{{ __('inkwave.dash_payment_status') }}</th>
                                            <th>{{ __('inkwave.dash_date') }}</th>
                                            <th>{{ __('inkwave.dash_action') }}</th>
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
                                                        <span class="dash-tag dash-tag--ok">{{ __('inkwave.dash_paid') }}</span>
                                                    @elseif($order->payment_status === 'Failed')
                                                        <span class="dash-tag dash-tag--err">{{ __('inkwave.dash_failed') }}</span>
                                                    @else
                                                        <span class="dash-tag">{{ __('inkwave.dash_pending') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td><a href="{{ route('user.order.show', $order->id) }}" class="dash-view"><i class="fas fa-eye"></i> {{ __('inkwave.dash_view') }}</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="dash-empty"><i class="fas fa-inbox"></i><p>{{ __('inkwave.dash_no_past_orders') }}</p></div>
                        @endif
                    </div>
                </div>

                {{-- Redeemed --}}
                <div class="dash-panel" data-panel="redeemed">
                    <div class="dash-card">
                        <h2 class="dash-h">{{ __('inkwave.dash_points_redeemed_courses') }}</h2>
                        @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                            <div class="dash-tablewrap">
                                <table class="dash-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('inkwave.dash_order_number') }}</th>
                                            <th>{{ __('inkwave.dash_artwork_name') }}</th>
                                            <th>{{ __('inkwave.dash_level') }}</th>
                                            <th>{{ __('inkwave.dash_points_used') }}</th>
                                            <th>{{ __('inkwave.dash_payment_status') }}</th>
                                            <th>{{ __('inkwave.dash_date') }}</th>
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
                                                        <span class="dash-tag dash-tag--ok">{{ __('inkwave.dash_redeemed') }}</span>
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
                            <div class="dash-empty"><i class="fas fa-palette"></i><p>{{ __('inkwave.dash_no_past_orders') }}</p></div>
                        @endif
                    </div>
                </div>

                {{-- Change password --}}
                <div class="dash-panel" data-panel="password">
                    <div class="dash-card">
                        <h2 class="dash-h">{{ __('inkwave.dash_change_password') }}</h2>
                        <form action="{{ route('change.password') }}" method="POST" class="dash-form">
                            @csrf
                            <div class="dash-field">
                                <label class="dash-label" for="current_password">{{ __('inkwave.dash_current_password') }}</label>
                                <input type="password" id="current_password" name="current_password" placeholder="{{ __('inkwave.dash_current_password_placeholder') }}" class="dash-input @error('current_password') is-invalid @enderror">
                                @error('current_password')<span class="dash-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="dash-field">
                                <label class="dash-label" for="new_password">{{ __('inkwave.dash_new_password') }}</label>
                                <input type="password" id="new_password" name="new_password" placeholder="{{ __('inkwave.dash_new_password_placeholder') }}" class="dash-input @error('new_password') is-invalid @enderror">
                                @error('new_password')<span class="dash-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="dash-field">
                                <label class="dash-label" for="new_confirm_password">{{ __('inkwave.dash_confirm_password') }}</label>
                                <input type="password" id="new_confirm_password" name="new_confirm_password" placeholder="{{ __('inkwave.dash_confirm_password_placeholder') }}" class="dash-input @error('new_confirm_password') is-invalid @enderror">
                                @error('new_confirm_password')<span class="dash-error">{{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="dash-submit"><i class="fas fa-check"></i> {{ __('inkwave.dash_update_password') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection



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
