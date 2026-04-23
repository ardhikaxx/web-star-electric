@php
    $currentUser = auth()->user();
    $isEmployeePanel = $currentUser?->isEmployee();
    $dashboardRoute = $isEmployeePanel ? route('employee.dashboard') : route('admin.dashboard');
    $profileRoute = $isEmployeePanel ? route('employee.profile.edit') : route('admin.profile.edit');
@endphp

<aside class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-brand">
            <a href="{{ $dashboardRoute }}" class="brand-logo">
                <img src="{{ asset('assets/logo-sidebar.png') }}" alt="STAR SEPEDA LISTRIK" class="brand-sidebar-image">
                <span class="brand-caption">{{ $isEmployeePanel ? 'Panel pelaporan karyawan' : 'Panel pengelolaan admin' }}</span>
            </a>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-title">Menu</div>
            <a href="{{ $dashboardRoute }}" class="menu-item {{ request()->routeIs($isEmployeePanel ? 'employee.dashboard' : 'admin.dashboard') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-house"></i>
                </span>
                <span class="menu-label">Dashboard</span>
            </a>

            @if ($isEmployeePanel)
                <a href="{{ route('employee.reports.index') }}" class="menu-item {{ request()->routeIs('employee.reports.*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </span>
                    <span class="menu-label">Pelaporan</span>
                </a>
            @else
                <a href="{{ route('admin.products.index') }}" class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-box"></i>
                    </span>
                    <span class="menu-label">Produk Katalog</span>
                </a>
                <a href="{{ route('admin.employees.index') }}" class="menu-item {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <span class="menu-label">Manajemen Karyawan</span>
                </a>
                <a href="{{ route('admin.sales-products.index') }}" class="menu-item {{ request()->routeIs('admin.sales-products.*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-cash-register"></i>
                    </span>
                    <span class="menu-label">Produk Penjualan</span>
                </a>
                <a href="{{ route('admin.reports.index') }}" class="menu-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                    <span class="menu-label">Laporan Admin</span>
                </a>
            @endif

            <a href="{{ $profileRoute }}" class="menu-item {{ request()->routeIs($isEmployeePanel ? 'employee.profile.*' : 'admin.profile.*') ? 'active' : '' }}">
                <span class="menu-icon">
                    <i class="fa-solid fa-user-gear"></i>
                </span>
                <span class="menu-label">Profile</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ url('/') }}" target="_blank" class="footer-link">
                <span class="footer-link-icon">
                    <i class="fa-solid fa-globe"></i>
                </span>
                <span class="footer-link-title">Lihat Website</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="logout-form" data-swal-confirm
                data-confirm-title="Keluar dari panel?"
                data-confirm-text="Sesi login saat ini akan diakhiri dan Anda perlu login kembali."
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
