<style>
    .modern-sidebar {
        background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
        border-right: 1px solid rgba(21, 145, 220, 0.12);
        min-height: 100vh;
        padding: 0;
    }

    .sidebar-brand {
        background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%);
        padding: 24px 20px;
        border-bottom: 1px solid rgba(21, 145, 220, 0.2);
    }

    .sidebar-brand-text {
        color: white;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .sidebar-breadcrumb {
        padding: 16px 20px;
        background: rgba(21, 145, 220, 0.04);
        border-bottom: 1px solid rgba(21, 145, 220, 0.1);
        font-size: 12px;
    }

    .sidebar-breadcrumb a {
        color: #1591DC;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .sidebar-breadcrumb a:hover {
        color: #0066B2;
        text-decoration: underline;
    }

    .sidebar-breadcrumb .separator {
        color: #94a3b8;
        margin: 0 8px;
    }

    .sidebar-nav {
        padding: 20px 0;
        list-style: none;
    }

    .sidebar-heading {
        padding: 12px 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #1591DC;
        letter-spacing: 0.5px;
        margin-top: 12px;
    }

    .sidebar-heading:first-child {
        margin-top: 0;
    }

    .sidebar-divider {
        margin: 16px 0;
        border: none;
        border-top: 1px solid rgba(21, 145, 220, 0.1);
    }

    .sidebar-nav .nav-item {
        margin: 0;
        padding: 0;
    }

    .sidebar-nav .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        color: #666;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        font-weight: 500;
        font-size: 14px;
    }

    .sidebar-nav .nav-link i {
        width: 20px;
        text-align: center;
        font-size: 16px;
        color: #94a3b8;
        transition: all 0.3s ease;
    }

    .sidebar-nav .nav-link:hover {
        background: rgba(21, 145, 220, 0.08);
        color: #1591DC;
        padding-left: 24px;
    }

    .sidebar-nav .nav-link:hover i {
        color: #1591DC;
    }

    .sidebar-nav .nav-item.active .nav-link {
        background: rgba(21, 145, 220, 0.12);
        color: #1591DC;
        border-left: 3px solid #1591DC;
        padding-left: 17px;
    }

    .sidebar-nav .nav-item.active .nav-link i {
        color: #1591DC;
    }

    @media (max-width: 768px) {
        .modern-sidebar {
            position: fixed;
            left: -100%;
            top: 0;
            width: 280px;
            z-index: 1000;
            transition: left 0.3s ease;
            box-shadow: 0 10px 40px rgba(21, 145, 220, 0.2);
        }

        .modern-sidebar.show {
            left: 0;
        }
    }
</style>

<ul class="sidebar-nav modern-sidebar" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user')}}">
        <div class="sidebar-brand-text">{{ $misc['Company Name'] ?? 'RiseBeyond' }}</div>
    </a>

    <!-- Breadcrumb -->
    <div class="sidebar-breadcrumb">
        <a href="{{route('home')}}">Home</a>
        <span class="separator">/</span>
        <a href="{{route('user')}}">Dashboard</a>
        <span class="separator">/</span>
        <span style="color: #0a0e27;">{{ Request::is('user/order*') ? 'Orders' : (Request::is('user/review*') ? 'Reviews' : 'Account') }}</span>
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('user') && !Request::is('user/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('user')}}">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Learning & Orders</div>

    <!-- Orders -->
    <li class="nav-item {{ Request::is('user/order*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('user.order.index')}}">
            <i class="fas fa-shopping-bag"></i>
            <span>My Orders</span>
        </a>
    </li>

    <!-- Reviews -->
    <li class="nav-item {{ Request::is('user/review*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('user.productreview.index')}}">
            <i class="fas fa-star"></i>
            <span>Reviews</span>
        </a>
    </li>

</ul>
