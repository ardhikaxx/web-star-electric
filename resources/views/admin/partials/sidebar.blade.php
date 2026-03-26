<aside class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <span class="brand-mark">
                <i class="fa-solid fa-bolt"></i>
            </span>
            <span class="brand-text">
                <span class="brand-name">STAR Admin</span>
                <small class="brand-sub">Kendalikan panel</small>
            </span>
        </a>
        <span class="brand-pill">Live</span>
    </div>

    <div class="sidebar-card">
        <div class="card-icon">
            <i class="fa-solid fa-chart-line"></i>
        </div>
        <div class="card-text">
            <p class="card-title">Performa stabil</p>
            <p class="card-sub">Pantau produk & pesanan langsung.</p>
        </div>
    </div>

    <nav class="sidebar-menu">
        <div class="menu-title">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <div class="item-left">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </div>
            <span class="chevron"><i class="fa-solid fa-angle-right"></i></span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <div class="item-left">
                <i class="fa-solid fa-box"></i>
                <span>Produk</span>
            </div>
            <span class="chevron"><i class="fa-solid fa-angle-right"></i></span>
        </a>
        <a href="{{ route('admin.change-pin') }}" class="menu-item {{ request()->routeIs('admin.change-pin') ? 'active' : '' }}">
            <div class="item-left">
                <i class="fa-solid fa-key"></i>
                <span>Ganti PIN</span>
            </div>
            <span class="chevron"><i class="fa-solid fa-angle-right"></i></span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ url('/') }}" target="_blank">
            <div class="item-left">
                <i class="fa-solid fa-globe"></i>
                <span>Lihat Website</span>
            </div>
            <span class="chevron"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <div class="item-left">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </div>
                <span class="chevron"><i class="fa-solid fa-angle-right"></i></span>
            </button>
        </form>
    </div>
</aside>
