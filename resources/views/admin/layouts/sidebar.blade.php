<aside class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-bolt"></i>
            STAR ADMIN
        </a>
    </div>
    <nav class="sidebar-menu">
        <div class="menu-title">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="fa-solid fa-box"></i>
            Produk
        </a>
    </nav>
    <div class="sidebar-footer">
        <a href="{{ url('/') }}" target="_blank">
            <i class="fa-solid fa-globe"></i>
            Lihat Website
        </a>
        <a href="{{ route('admin.change-pin') }}" class="{{ request()->routeIs('admin.change-pin') ? 'active' : '' }}">
            <i class="fa-solid fa-key"></i>
            Ganti PIN
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" style="background: none; border: none; color: rgba(255,255,255,0.6); padding: 0.5rem 0; cursor: pointer; display: flex; align-items: center; gap: 0.75rem; width: 100%;">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>
</aside>