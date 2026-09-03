@extends('frontend.layouts.main')
@section('title', __('inkwave.db_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.db_my_account'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.db_my_account')]
    ]
])



<div class="duo-dash-wrap">
    @php $u = Auth::user(); @endphp
    <div class="duo-dash-container">

        {{-- ================= SIDEBAR ================= --}}
        <aside class="duo-dash-side">
            <div class="duo-dash-card">
                <div class="duo-dash-profile">
                    <span class="duo-dash-avatar">{{ strtoupper(substr($u->name ?? 'U', 0, 1)) }}</span>
                    <span class="duo-dash-name">{{ $u->name }}</span>
                    <span class="duo-dash-email">{{ $u->email }}</span>
                </div>

                <div class="duo-dash-stats">
                    <div class="duo-dash-stat">
                        <span>{{ __('inkwave.db_available_points') }}</span>
                        <span><i class="fas fa-coins"></i> {{ number_format($u->points_balance ?? 0) }}</span>
                    </div>
                    <div class="duo-dash-stat">
                        <span>{{ __('inkwave.db_courses_enrolled') }}</span>
                        <span>{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</span>
                    </div>
                    <div class="duo-dash-stat">
                        <span>{{ __('inkwave.db_member_since') }}</span>
                        <span>{{ $u->created_at->format('M Y') }}</span>
                    </div>
                </div>

                <nav class="duo-dash-nav">
                    <button type="button" class="duo-dash-navbtn active" data-tab="purchased"><i class="fas fa-gift"></i> {{ __('inkwave.db_points_purchased') }}</button>
                    <button type="button" class="duo-dash-navbtn" data-tab="redeemed"><i class="fas fa-book-reader"></i> {{ __('inkwave.db_points_redeemed') }}</button>
                    <button type="button" class="duo-dash-navbtn" data-tab="password"><i class="fas fa-lock"></i> {{ __('inkwave.db_change_password') }}</button>
                    <a href="{{ route('user.logout') }}" class="duo-dash-navbtn duo-dash-navbtn--logout"><i class="fas fa-sign-out-alt"></i> {{ __('inkwave.db_logout') }}</a>
                </nav>
            </div>
        </aside>

        {{-- ================= CONTENT ================= --}}
        <div class="duo-dash-main">

            {{-- Purchases --}}
            <div class="duo-dash-panel active" data-panel="purchased">
                <div class="duo-dash-card">
                    <h2 class="duo-dash-h"><i class="fas fa-gift"></i> {{ __('inkwave.db_points_purchased_wallet') }}</h2>
                    @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                        <div class="duo-dash-tablewrap">
                            <table class="duo-dash-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('inkwave.db_order_number') }}</th>
                                        <th>{{ __('inkwave.db_points_bought') }}</th>
                                        <th>{{ __('inkwave.db_price_paid') }}</th>
                                        <th>{{ __('inkwave.db_payment_status') }}</th>
                                        <th>{{ __('inkwave.db_date') }}</th>
                                        <th>{{ __('inkwave.db_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchasedOrders as $order)
                                        <tr>
                                            <td class="is-strong">{{ $order->order_number }}</td>
                                            <td><span class="duo-dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                            <td class="is-strong">{{ Helper::getCurrencySymbol($order->currency) }}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</td>
                                            <td>
                                                @if($order->payment_status === 'Completed')
                                                    <span class="duo-dash-tag duo-dash-tag--ok">{{ __('inkwave.db_paid') }}</span>
                                                @elseif($order->payment_status === 'Failed')
                                                    <span class="duo-dash-tag duo-dash-tag--err">{{ __('inkwave.db_failed') }}</span>
                                                @else
                                                    <span class="duo-dash-tag">{{ __('inkwave.db_pending') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td><a href="{{ route('user.order.show', $order->id) }}" class="duo-dash-view"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="duo-dash-empty">
                            <i class="fas fa-box-open"></i>
                            <p>{{ __('inkwave.db_no_past_orders') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Redeemed --}}
            <div class="duo-dash-panel" data-panel="redeemed">
                <div class="duo-dash-card">
                    <h2 class="duo-dash-h"><i class="fas fa-book-reader"></i> {{ __('inkwave.db_points_redeemed_courses') }}</h2>
                    @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                        <div class="duo-dash-tablewrap">
                            <table class="duo-dash-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('inkwave.db_order_number') }}</th>
                                        <th>{{ __('inkwave.db_course_name') }}</th>
                                        <th>{{ __('inkwave.db_level') }}</th>
                                        <th>{{ __('inkwave.db_points_used') }}</th>
                                        <th>{{ __('inkwave.db_payment_status') }}</th>
                                        <th>{{ __('inkwave.db_date') }}</th>
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
                                            <td class="is-strong">{{ $cartItem && $cartItem->product ? $cartItem->product->title : 'N/A' }}</td>
                                            <td>
                                                @if($level)<span class="duo-dash-tag">{{ ucfirst($level->skill_level) }}</span>@else<span class="duo-dash-tag duo-dash-tag--muted">N/A</span>@endif
                                            </td>
                                            <td><span class="duo-dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                            <td>
                                                @if(strtolower($order->status) === 'completed')
                                                    <span class="duo-dash-tag duo-dash-tag--ok">{{ __('inkwave.db_redeemed') }}</span>
                                                @else
                                                    <span class="duo-dash-tag">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="duo-dash-empty">
                            <i class="fas fa-box-open"></i>
                            <p>{{ __('inkwave.db_no_past_orders') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Change password --}}
            <div class="duo-dash-panel" data-panel="password">
                <div class="duo-dash-card">
                    <h2 class="duo-dash-h"><i class="fas fa-lock"></i> {{ __('inkwave.db_change_password') }}</h2>
                    <form action="{{ route('change.password') }}" method="POST">
                        @csrf
                        <div class="duo-dash-field">
                            <label class="duo-dash-label" for="current_password">{{ __('inkwave.db_current_password') }}</label>
                            <input type="password" id="current_password" name="current_password" placeholder="{{ __('inkwave.db_current_password_placeholder') }}" class="duo-dash-input @error('current_password') is-invalid @enderror">
                            @error('current_password')<span class="duo-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                        </div>
                        <div class="duo-dash-field">
                            <label class="duo-dash-label" for="new_password">{{ __('inkwave.db_new_password') }}</label>
                            <input type="password" id="new_password" name="new_password" placeholder="{{ __('inkwave.db_new_password_placeholder') }}" class="duo-dash-input @error('new_password') is-invalid @enderror">
                            @error('new_password')<span class="duo-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                        </div>
                        <div class="duo-dash-field">
                            <label class="duo-dash-label" for="new_confirm_password">{{ __('inkwave.db_confirm_password') }}</label>
                            <input type="password" id="new_confirm_password" name="new_confirm_password" placeholder="{{ __('inkwave.db_confirm_password_placeholder') }}" class="duo-dash-input @error('new_confirm_password') is-invalid @enderror">
                            @error('new_confirm_password')<span class="duo-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="duo-dash-submit"><i class="fas fa-check"></i> {{ __('inkwave.db_update_password') }}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var btns = document.querySelectorAll('.duo-dash-navbtn[data-tab]');
        var panels = document.querySelectorAll('.duo-dash-panel');
        btns.forEach(function (b) {
            b.addEventListener('click', function () {
                var t = this.getAttribute('data-tab');
                btns.forEach(function (x) { x.classList.remove('active'); });
                panels.forEach(function (p) { p.classList.remove('active'); });
                this.classList.add('active');
                var panel = document.querySelector('.duo-dash-panel[data-panel="' + t + '"]');
                if (panel) panel.classList.add('active');
            });
        });
        // If there are validation errors on the password form, open that tab
        @if($errors->any())
            var passTab = document.querySelector('.duo-dash-navbtn[data-tab="password"]');
            if (passTab) passTab.click();
        @endif
    })();
</script>
@endpush
