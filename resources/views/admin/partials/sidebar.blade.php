<aside class="sidebar">
    <div class="sidebar-inner">
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
        </div>

        <nav class="sidebar-menu">
            <div class="menu-title">Menu</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-house"></i>
                </span>
                <span class="menu-label">Dashboard</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-box"></i>
                </span>
                <span class="menu-label">Produk</span>
            </a>
            <a href="{{ route('admin.change-pin') }}" class="menu-item {{ request()->routeIs('admin.change-pin') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-key"></i>
                </span>
                <span class="menu-label">Ganti PIN</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ url('/') }}" target="_blank" class="footer-link">
                <span class="footer-link-icon">
                    <i class="fa-solid fa-globe"></i>
                </span>
                <span class="footer-link-title">Lihat Website</span>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="logout-form" data-swal-confirm
                data-confirm-title="Keluar dari panel admin?"
                data-confirm-text="Sesi admin saat ini akan diakhiri dan Anda perlu login kembali."
                data-confirm-button-text="Ya, logout"
                data-cancel-button-text="Batal"
                data-confirm-icon="question">
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
