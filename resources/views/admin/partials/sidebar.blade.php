<aside class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-top">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}" class="brand-logo">
                    <span class="brand-mark">
                        <i class="fa-solid fa-bolt"></i>
                    </span>
                    <span class="brand-text">
                        <span class="brand-name">STAR Admin</span>
                        <small class="brand-sub">Panel pengelolaan</small>
                    </span>
                </a>
                <span class="brand-pill">Live</span>
            </div>
        </div>

        <div class="sidebar-nav-shell">
            <nav class="sidebar-menu">
                <div class="menu-title">Navigasi</div>
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="menu-main">
                        <span class="menu-icon">
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="menu-label">Dashboard</span>
                    </span>
                    <span class="menu-indicator"></span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <span class="menu-main">
                        <span class="menu-icon">
                            <i class="fa-solid fa-box"></i>
                        </span>
                        <span class="menu-label">Produk</span>
                    </span>
                    <span class="menu-indicator"></span>
                </a>
                <a href="{{ route('admin.change-pin') }}" class="menu-item {{ request()->routeIs('admin.change-pin') ? 'active' : '' }}">
                    <span class="menu-main">
                        <span class="menu-icon">
                            <i class="fa-solid fa-key"></i>
                        </span>
                        <span class="menu-label">Ganti PIN</span>
                    </span>
                    <span class="menu-indicator"></span>
                </a>
            </nav>
        </div>

        <div class="sidebar-footer">
            <div class="footer-label">Akses cepat</div>
            <a href="{{ url('/') }}" target="_blank" class="footer-link">
                <span class="footer-link-icon">
                    <i class="fa-solid fa-globe"></i>
                </span>
                <span class="footer-link-title">Lihat Website</span>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <div class="item-left">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</aside>
