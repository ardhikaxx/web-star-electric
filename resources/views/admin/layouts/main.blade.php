<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - STAR SEPEDA LISTRIK')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        :root {
            --bg: #f4f8fb;
            --surface: rgba(255, 255, 255, 0.72);
            --surface-strong: #ffffff;
            --text: #102132;
            --muted: #607080;
            --text-muted: #607080;
            --primary: #FF0205;
            --primary-dark: #DA0003;
            --accent: #f59e0b;
            --line: rgba(16, 33, 50, 0.08);
            --shadow: 0 20px 60px rgba(8, 19, 33, 0.12);
            --radius-lg: 28px;
            --radius-md: 20px;
            --radius-sm: 16px;
            --sidebar-width: 260px;
            --bg-light: #f4f8fb;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --primary-light-alpha: rgba(255, 2, 5, 0.15); /* Added for consistent focus states */
            --success-light-alpha: rgba(16, 185, 129, 0.1);
            --warning-light-alpha: rgba(245, 158, 11, 0.1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255, 2, 5, 0.14), transparent 28%),
                radial-gradient(circle at top right, rgba(245, 158, 11, 0.12), transparent 20%),
                linear-gradient(180deg, #f8fbfd 0%, #eef5f8 100%);
            color: var(--text);
            margin: 0;
            min-height: 100vh;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: radial-gradient(circle at 30% 10%, rgba(255,255,255,0.12), transparent 32%),
                        linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            box-shadow: 0 24px 50px rgba(255, 2, 5, 0.25);
            border-right: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
        }

        .sidebar-brand {
            padding: 1.1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            color: #fff;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: inherit;
            text-decoration: none;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.18);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #fff;
            box-shadow: 0 12px 28px rgba(0,0,0,0.15);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .brand-name {
            font-weight: 700;
            font-size: 1rem;
        }

        .brand-sub {
            color: rgba(255,255,255,0.8);
            font-size: 0.8rem;
        }

        .brand-pill {
            border: 1px solid rgba(255,255,255,0.45);
            background: rgba(255,255,255,0.18);
            color: #fff;
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            letter-spacing: 0.3px;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.12);
        }

        .sidebar-card {
            margin: 0.25rem 1.25rem 1rem;
            padding: 1rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 16px;
            color: #fff;
            display: flex;
            gap: 0.85rem;
            box-shadow: 0 16px 30px rgba(0,0,0,0.18);
        }

        .sidebar-card .card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255,255,255,0.14);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .sidebar-card .card-title {
            font-weight: 700;
            margin: 0;
        }

        .sidebar-card .card-sub {
            margin: 0.15rem 0 0;
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
        }

        .sidebar-card .card-text {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
        }

        .sidebar-menu {
            flex: 1;
            padding: 0.35rem 0 0.75rem;
            overflow-y: auto;
        }

        .sidebar-menu .menu-title {
            color: rgba(255,255,255,0.55);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.5rem 1.5rem 0.35rem;
            font-weight: 700;
        }

        .sidebar-menu .menu-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            padding: 0.85rem 1.5rem;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
            position: relative;
        }

        .menu-item .item-left {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .menu-item i {
            width: 1.2rem;
            text-align: center;
            font-size: 1rem;
        }

        .menu-item .chevron {
            color: rgba(255,255,255,0.35);
            font-size: 0.85rem;
        }

        .menu-item:hover {
            color: #fff;
            transform: translateX(4px);
        }

        .menu-item:hover .chevron,
        .menu-item.active .chevron {
            color: #fff;
        }

        .menu-item.active {
            background: rgba(255,255,255,0.14);
            color: #fff;
            border-left-color: #fff;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
        }

        .sidebar-footer {
            padding: 1rem 1.3rem 1.2rem;
            border-top: 1px solid rgba(255,255,255,0.14);
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .sidebar-footer a,
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            padding: 0.7rem 0.85rem;
            transition: all 0.2s ease;
            border-radius: 12px;
            border: 1px solid transparent;
            background: rgba(255,255,255,0.06);
        }

        .sidebar-footer a .item-left,
        .logout-btn .item-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-footer a:hover,
        .logout-btn:hover {
            color: #fff;
            border-color: rgba(255,255,255,0.25);
            background: rgba(255,255,255,0.12);
        }

        .logout-btn {
            width: 100%;
            text-align: left;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            cursor: pointer;
        }

        .logout-btn .chevron {
            color: rgba(255,255,255,0.35);
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .top-header {
            background: rgba(255,255,255,0.85);
            padding: 1rem 1.5rem;
            box-shadow: 0 16px 40px rgba(0,0,0,0.08);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0.75rem;
            margin: 1rem 1.5rem 0.5rem;
            z-index: 120;
            backdrop-filter: blur(14px);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: 1px solid var(--border);
            font-size: 1.25rem;
            color: var(--text);
            cursor: pointer;
            padding: 0.55rem 0.7rem;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }

        .page-meta {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.72rem;
            color: var(--muted);
        }

        .title-wrap {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text);
            margin: 0;
        }

        .live-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 0 6px rgba(16, 185, 129, 0.18);
        }

        .page-subtitle {
            margin: 0;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-search {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            background: #f7fafc;
            border: 1px solid var(--border);
            padding: 0.6rem 0.8rem;
            border-radius: 12px;
            min-width: 220px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
        }

        .header-search input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            color: var(--text);
        }

        .header-search input::placeholder {
            color: var(--muted);
        }

        .header-divider {
            width: 1px;
            height: 40px;
            background: var(--border);
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(120deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            padding: 0.55rem 0.7rem 0.55rem 0.9rem;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(255, 2, 5, 0.18);
            border: 1px solid rgba(255,255,255,0.18);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-name {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.9);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
            border: 1px solid rgba(255,255,255,0.25);
        }

        .page-content {
            padding: 1.5rem 2rem;
        }

        .breadcrumb-custom {
            background: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }

        .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
            content: "/";
            color: var(--text-muted);
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--text-muted);
        }

        .card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border);
            padding: 1rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            color: var(--text);
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-danger {
            background: var(--danger);
            border-color: var(--danger);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(230, 32, 38, 0.15);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: var(--bg-light);
            border-bottom: 2px solid var(--border);
            color: var(--text);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }

        .table tbody tr:hover {
            background: rgba(230, 32, 38, 0.03);
        }

        .table-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--border);
        }

        .alert {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid var(--warning);
            color: #856404;
            border-radius: 8px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.primary {
            background: rgba(230, 32, 38, 0.1);
            color: var(--primary);
        }

        .stat-icon.success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .stat-info h3 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
            color: var(--text);
        }

        .stat-info p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .pagination {
            margin-top: 1.5rem;
        }

        .page-link {
            color: var(--primary);
            border-color: var(--border);
        }

        .page-link:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }

        .offcanvas-backdrop.show {
            opacity: 0.5;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .page-content {
                padding: 1rem 1.1rem 1.5rem;
            }

            .top-header {
                margin: 0.5rem 1rem 0.25rem;
                padding: 0.9rem 1rem;
                border-radius: 14px;
            }

            .header-actions {
                gap: 0.75rem;
            }

            .header-search {
                min-width: 160px;
            }
        }

        @media (max-width: 767.98px) {
            .header-left {
                gap: 0.75rem;
            }

            .page-meta {
                gap: 0.2rem;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-end;
                flex-wrap: wrap;
            }

            .header-search {
                order: 3;
                width: 100%;
                min-width: 0;
            }

            .header-divider {
                display: none;
            }

            .user-chip {
                width: 100%;
                justify-content: space-between;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }

            .stat-info h3 {
                font-size: 1.5rem;
            }

            .table {
                font-size: 0.85rem;
            }

            .table-img {
                width: 45px;
                height: 45px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        @include('admin.partials.sidebar')
        
        <div class="main-content">
            @include('admin.partials.header')

            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="sidebar-overlay"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');

            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });

                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
