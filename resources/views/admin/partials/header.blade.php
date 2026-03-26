<header class="top-header">
    <div class="header-left">
        <button class="menu-toggle" aria-label="Toggle sidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="page-meta">
            <span class="eyebrow">Area Admin</span>
            <div class="title-wrap">
                <h1 class="header-title">@yield('page-title', 'Dashboard')</h1>
                <span class="live-dot" title="Aktif"></span>
            </div>
            <p class="page-subtitle">Kelola konten dan transaksi dengan cepat.</p>
        </div>
    </div>

    <div class="header-actions">
        <div class="header-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" placeholder="Cari menu atau produk…" aria-label="Cari">
        </div>
        <div class="header-divider"></div>
        <div class="user-chip">
            <div class="user-info">
                <span class="user-name">Admin</span>
                <small class="user-role">Superuser</small>
            </div>
            <div class="user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </div>
</header>
