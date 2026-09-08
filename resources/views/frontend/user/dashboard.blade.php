@extends('frontend.layouts.main')
@section('title', __('managenovax.dashboard.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.dashboard.my_account'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.dashboard.my_account')]
    ]
])




<div class="ag-dash-wrap">
    @php $u = Auth::user(); @endphp
    <div class="ag-container">

        <div class="ag-dash-grid">
            
            {{-- ================= SIDEBAR ================= --}}
            <aside class="ag-dash-sidebar">
                <div class="ag-dash-profile">
                    <div class="ag-dash-avatar">{{ strtoupper(substr($u->name ?? 'U', 0, 1)) }}</div>
                    <span class="ag-dash-name">{{ $u->name }}</span>
                    <span class="ag-dash-email">{{ $u->email }}</span>
                </div>

                <div class="ag-dash-stats">
                    <div class="ag-dash-stat">
                        <span>{{ __('managenovax.dashboard.credits_avail') }}</span>
                        <span><i class="fas fa-coins"></i> {{ number_format($u->points_balance ?? 0) }}</span>
                    </div>
                    <div class="ag-dash-stat">
                        <span>{{ __('managenovax.dashboard.courses_enrolled') }}</span>
                        <span>{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</span>
                    </div>
                    <div class="ag-dash-stat">
                        <span>{{ __('managenovax.dashboard.member_since') }}</span>
                        <span>{{ $u->created_at->format('M Y') }}</span>
                    </div>
                </div>

                <nav class="ag-dash-nav">
                    <button type="button" class="ag-dash-navbtn active" data-tab="purchased"><i class="fas fa-gift"></i> {{ __('managenovax.dashboard.tab_purchased') }}</button>
                    <button type="button" class="ag-dash-navbtn" data-tab="redeemed"><i class="fas fa-book-reader"></i> {{ __('managenovax.dashboard.tab_redeemed') }}</button>
                    <button type="button" class="ag-dash-navbtn" data-tab="password"><i class="fas fa-lock"></i> {{ __('managenovax.dashboard.tab_pwd') }}</button>
                    <a href="{{ route('user.logout') }}" class="ag-dash-navbtn ag-dash-navbtn--logout"><i class="fas fa-sign-out-alt"></i> {{ __('managenovax.dashboard.logout') }}</a>
                </nav>
            </aside>

            {{-- ================= CONTENT ================= --}}
            <div class="ag-dash-main">

                {{-- Purchases --}}
                <div class="ag-dash-panel active" data-panel="purchased">
                    <div class="ag-dash-card">
                        <h2 class="ag-dash-h"><i class="fas fa-gift"></i> {{ __('managenovax.dashboard.heading_purchased') }}</h2>
                        @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                            <div class="ag-dash-tablewrap">
                                <table class="ag-dash-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('managenovax.dashboard.col_order_num') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_credits') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_price') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_status') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_date') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchasedOrders as $order)
                                            <tr>
                                                <td class="is-strong">{{ $order->order_number }}</td>
                                                <td><span class="ag-dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                                <td class="is-strong">{!! $order->currency=='JPY' ? '&yen;' : Helper::getCurrencySymbol($order->currency) !!}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</td>
                                                <td>
                                                    @if($order->payment_status === 'Completed')
                                                        <span class="ag-dash-tag ag-dash-tag--ok">{{ __('managenovax.dashboard.status_paid') }}</span>
                                                    @elseif($order->payment_status === 'Failed')
                                                        <span class="ag-dash-tag ag-dash-tag--err">{{ __('managenovax.dashboard.status_failed') }}</span>
                                                    @else
                                                        <span class="ag-dash-tag">{{ __('managenovax.dashboard.status_pending') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td><a href="{{ route('user.order.show', $order->id) }}" class="ag-dash-view"><i class="fas fa-eye"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="ag-dash-empty">
                                <i class="fas fa-box-open"></i>
                                <p>{{ __('managenovax.dashboard.empty_redeemed') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Redeemed --}}
                <div class="ag-dash-panel" data-panel="redeemed">
                    <div class="ag-dash-card">
                        <h2 class="ag-dash-h"><i class="fas fa-book-reader"></i> {{ __('managenovax.dashboard.heading_redeemed') }}</h2>
                        @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                            <div class="ag-dash-tablewrap">
                                <table class="ag-dash-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('managenovax.dashboard.col_order_num') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_course') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_level') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_credits_used') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_status') }}</th>
                                            <th>{{ __('managenovax.dashboard.col_date') }}</th>
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
                                                    @if($level)<span class="ag-dash-tag">{{ __('managenovax.course.skill_' . strtolower($level->skill_level)) }}</span>@else<span class="ag-dash-tag ag-dash-tag--muted">N/A</span>@endif
                                                </td>
                                                <td><span class="ag-dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                                <td>
                                                    @if(strtolower($order->status) === 'completed')
                                                        <span class="ag-dash-tag ag-dash-tag--ok">{{ __('managenovax.dashboard.status_redeemed') }}</span>
                                                    @else
                                                        <span class="ag-dash-tag">{{ $order->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="ag-dash-empty">
                                <i class="fas fa-box-open"></i>
                                <p>{{ __('managenovax.dashboard.empty_redeemed') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Change password --}}
                <div class="ag-dash-panel" data-panel="password">
                    <div class="ag-dash-card">
                        <h2 class="ag-dash-h"><i class="fas fa-lock"></i> {{ __('managenovax.dashboard.tab_pwd') }}</h2>
                        <form action="{{ route('change.password') }}" method="POST">
                            @csrf
                            <div class="ag-dash-field">
                                <label class="ag-dash-label" for="current_password">{{ __('managenovax.dashboard.db_current_password') }}</label>
                                <input type="password" id="current_password" name="current_password" placeholder="{{ __('managenovax.dashboard.db_current_password_placeholder') }}" class="ag-dash-input @error('current_password') is-invalid @enderror">
                                @error('current_password')<span class="ag-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                            </div>
                            <div class="ag-dash-field">
                                <label class="ag-dash-label" for="new_password">{{ __('managenovax.dashboard.db_new_password') }}</label>
                                <input type="password" id="new_password" name="new_password" placeholder="{{ __('managenovax.dashboard.db_new_password_placeholder') }}" class="ag-dash-input @error('new_password') is-invalid @enderror">
                                @error('new_password')<span class="ag-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                            </div>
                            <div class="ag-dash-field">
                                <label class="ag-dash-label" for="new_confirm_password">{{ __('managenovax.dashboard.db_confirm_password') }}</label>
                                <input type="password" id="new_confirm_password" name="new_confirm_password" placeholder="{{ __('managenovax.dashboard.db_confirm_password_placeholder') }}" class="ag-dash-input @error('new_confirm_password') is-invalid @enderror">
                                @error('new_confirm_password')<span class="ag-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="ag-dash-submit"><i class="fas fa-check"></i> {{ __('managenovax.dashboard.db_update_password') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var btns = document.querySelectorAll('.ag-dash-navbtn[data-tab]');
        var panels = document.querySelectorAll('.ag-dash-panel');
        btns.forEach(function (b) {
            b.addEventListener('click', function () {
                var t = this.getAttribute('data-tab');
                btns.forEach(function (x) { x.classList.remove('active'); });
                panels.forEach(function (p) { p.classList.remove('active'); });
                this.classList.add('active');
                var panel = document.querySelector('.ag-dash-panel[data-panel="' + t + '"]');
                if (panel) panel.classList.add('active');
            });
        });
        // If there are validation errors on the password form, open that tab
        @if($errors->any())
            var passTab = document.querySelector('.ag-dash-navbtn[data-tab="password"]');
            if (passTab) passTab.click();
        @endif
    })();
</script>
@endpush
