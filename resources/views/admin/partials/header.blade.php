@php
    $currentUser = auth()->user();
    $isEmployeePanel = $currentUser?->isEmployee();
@endphp

<header class="top-header">
    <div class="header-left">
        <button class="menu-toggle" aria-label="Toggle sidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="header-title-block">
            <span class="header-kicker">{{ $isEmployeePanel ? 'Panel Karyawan' : 'Panel Admin' }}</span>
            <h1 class="header-title">@yield('page-title', 'Dashboard')</h1>
        </div>
    </div>

    <div class="header-user">
        <div class="user-avatar">
            {{ $currentUser?->initials ?? 'US' }}
        </div>
        <div class="user-info">
            <span class="user-name">{{ $currentUser?->name ?? 'Pengguna' }}</span>
            <small class="user-role">
                <span class="user-status-dot"></span>
                {{ $isEmployeePanel ? 'Karyawan' : 'Admin' }}
            </small>
        </div>
    </div>
</header>
