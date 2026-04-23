<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Ar-Rahman E-Bike Bondowoso')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        :root {
            --bg: #f4f8fb;
            --surface: rgba(255, 255, 255, 0.72);
            --surface-strong: #ffffff;
            --text: #102132;
            --muted: #607080;
            --text-muted: #607080;
            --primary: #E53935;
            --primary-dark: #B71C1C;
            --accent: #f59e0b;
            --line: rgba(16, 33, 50, 0.08);
            --shadow: 0 20px 60px rgba(8, 19, 33, 0.12);
            --radius-lg: 28px;
            --radius-md: 20px;
            --radius-sm: 16px;
            --sidebar-width: 272px;
            --bg-light: #f4f8fb;
            --border: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --primary-light-alpha: rgba(255, 2, 5, 0.15); /* Added for consistent focus states */
            --success-light-alpha: rgba(16, 185, 129, 0.1);
            --warning-light-alpha: rgba(245, 158, 11, 0.1);
            --content-max: 1480px;
            --content-gutter: clamp(1rem, 2vw, 2rem);
        }

        * {
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
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
            overflow-x: hidden;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        .sidebar {
            width: var(--sidebar-width);
            max-width: 100%;
            background:
                radial-gradient(circle at 18% 8%, rgba(255,255,255,0.1), transparent 20%),
                linear-gradient(180deg, #ff1f24 0%, var(--primary-dark) 100%);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 0 24px 56px rgba(255, 2, 5, 0.22);
            border-right: 1px solid rgba(255,255,255,0.1);
            overflow: hidden;
        }

        .sidebar::before {
            content: "";
            position: absolute;
            inset: 16px;
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,0.08);
            pointer-events: none;
        }

        .sidebar-inner {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 1.2rem 0.95rem 1.05rem;
        }

        .sidebar-brand {
            padding: 0 0.25rem 1.1rem;
            margin-bottom: 0.85rem;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            display: flex;
            justify-content: center;
        }

        .brand-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.7rem;
            color: #fff;
            text-decoration: none;
            min-width: 0;
            width: 100%;
        }

        .brand-sidebar-image {
            width: min(100%, 176px);
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 24px rgba(97, 3, 5, 0.18));
        }

        .brand-caption {
            color: rgba(255,255,255,0.74);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            line-height: 1.3;
            text-align: center;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.18);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.08rem;
            color: #fff;
            flex-shrink: 0;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            min-width: 0;
            line-height: 1.18;
        }

        .brand-name {
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.2px;
        }

        .brand-sub {
            color: rgba(255,255,255,0.72);
            font-size: 0.78rem;
        }

        .sidebar-menu {
            flex: 1;
            min-height: 0;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            overflow-y: auto;
            padding: 0 0.1rem;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.16);
            border-radius: 999px;
        }

        .sidebar-menu .menu-title {
            color: rgba(255,255,255,0.58);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.2rem 0.45rem 0.3rem;
            font-weight: 700;
        }

        .sidebar-menu .menu-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.78rem;
            padding: 0.68rem 0.8rem 0.68rem 0.95rem;
            text-decoration: none;
            color: rgba(255,255,255,0.84);
            border-radius: 16px;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar-menu .menu-item::before {
            content: "";
            position: absolute;
            left: 0.35rem;
            top: 10px;
            bottom: 10px;
            width: 3px;
            border-radius: 999px;
            background: transparent;
            transition: background 0.2s ease;
        }

        .menu-icon,
        .footer-link-icon,
        .logout-btn .item-left i {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            color: #fff;
            flex-shrink: 0;
        }

        .menu-label,
        .footer-link-title {
            font-weight: 600;
            line-height: 1.2;
            min-width: 0;
        }

        .menu-item:hover,
        .footer-link:hover,
        .logout-btn:hover {
            color: #fff;
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.12);
        }

        .menu-item:hover .menu-icon,
        .footer-link:hover .footer-link-icon,
        .logout-btn:hover .item-left i {
            background: rgba(255,255,255,0.14);
            border-color: rgba(255,255,255,0.16);
        }

        .menu-item.active {
            color: #fff;
            background: rgba(255,255,255,0.14);
            border-color: rgba(255,255,255,0.16);
        }

        .menu-item.active::before {
            background: #fff;
        }

        .menu-item.active .menu-icon {
            background: #fff;
            color: var(--primary);
            border-color: rgba(255,255,255,0.3);
        }

        .sidebar-footer {
            margin-top: 0.9rem;
            padding-top: 0.9rem;
            border-top: 1px solid rgba(255,255,255,0.12);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .footer-link,
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.78rem;
            color: rgba(255,255,255,0.84);
            text-decoration: none;
            padding: 0.68rem 0.8rem;
            transition: all 0.2s ease;
            border-radius: 16px;
            border: 1px solid transparent;
            background: transparent;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .logout-btn .item-left {
            display: flex;
            align-items: center;
            gap: 0.78rem;
            min-width: 0;
        }

        .logout-btn .item-left span {
            font-weight: 600;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            min-width: 0;
            width: calc(100% - var(--sidebar-width));
        }

        .top-header {
            background: rgba(255,255,255,0.88);
            padding: clamp(0.9rem, 1.5vw, 1rem) clamp(1rem, 2vw, 1.35rem);
            box-shadow: 0 14px 32px rgba(0,0,0,0.06);
            border: 1px solid rgba(226, 232, 240, 0.95);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            position: sticky;
            top: 0.75rem;
            width: min(calc(100% - (var(--content-gutter) * 2)), var(--content-max));
            margin: 0.9rem auto 0;
            z-index: 120;
            backdrop-filter: blur(12px);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            min-width: 0;
            flex: 1;
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

        .header-title-block {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            min-width: 0;
        }

        .header-kicker {
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.72rem;
            color: var(--muted);
            font-weight: 700;
        }

        .header-title {
            font-size: clamp(1.16rem, 1.2rem + 0.5vw, 1.42rem);
            font-weight: 700;
            color: var(--text);
            margin: 0;
            line-height: 1.2;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.45rem 0.55rem 0.45rem 0.45rem;
            border-radius: 16px;
            border: 1px solid var(--line);
            background: #fff;
            box-shadow: 0 10px 20px rgba(8, 19, 33, 0.05);
            max-width: 100%;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            min-width: 0;
            overflow: hidden;
        }

        .user-name {
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.78rem;
            color: var(--muted);
            display: inline-flex;
            align-items: center;
            gap: 0.38rem;
            white-space: nowrap;
        }

        .user-status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.16);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.92rem;
            box-shadow: 0 12px 24px rgba(255, 2, 5, 0.18);
        }

        .page-content {
            width: min(100%, var(--content-max));
            margin: 0 auto;
            padding: clamp(1.15rem, 2vw, 1.5rem) var(--content-gutter) clamp(1.5rem, 2.4vw, 2rem);
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

        .table-responsive {
            border-radius: var(--radius-md);
            overflow: hidden;
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
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(8, 19, 33, 0.42);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        @media (max-width: 1199.98px) {
            :root {
                --sidebar-width: 252px;
                --content-gutter: clamp(1rem, 1.8vw, 1.5rem);
            }

            .top-header {
                top: 0.6rem;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: min(84vw, 332px);
                transform: translateX(-105%);
                box-shadow: none;
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 0 28px 60px rgba(255, 2, 5, 0.28);
            }

            .sidebar-inner {
                padding: 1rem 0.8rem 0.95rem;
            }

            body.sidebar-open {
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .menu-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .page-content {
                padding-top: 1rem;
            }

            .top-header {
                top: 0.5rem;
                border-radius: 18px;
            }
        }

        @media (max-width: 767.98px) {
            .sidebar {
                width: min(88vw, 320px);
            }

            .sidebar-inner {
                padding: 0.95rem 0.75rem 0.9rem;
            }

            .sidebar-brand {
                padding-bottom: 0.95rem;
                margin-bottom: 0.75rem;
            }

            .brand-sidebar-image {
                width: min(100%, 162px);
            }

            .header-left {
                gap: 0.75rem;
            }

            .top-header {
                width: 100%;
                flex-wrap: wrap;
                align-items: flex-start;
                gap: 0.85rem;
            }

            .header-title {
                font-size: 1.18rem;
            }

            .header-user {
                width: 100%;
                justify-content: flex-start;
            }

            .page-content {
                padding-top: 0.9rem;
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

        @media (max-width: 575.98px) {
            .sidebar::before {
                inset: 12px;
                border-radius: 22px;
            }

            .menu-icon,
            .footer-link-icon,
            .logout-btn .item-left i {
                width: 36px;
                height: 36px;
                border-radius: 11px;
            }

            .menu-item,
            .footer-link,
            .logout-btn {
                padding-inline: 0.72rem;
            }

            .brand-caption {
                font-size: 0.68rem;
            }

            .top-header {
                padding: 0.85rem 0.9rem;
                border-radius: 16px;
            }

            .header-kicker {
                font-size: 0.68rem;
            }

            .header-user {
                padding: 0.4rem;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 12px;
            }

            .page-content {
                padding-bottom: 1.4rem;
            }

            .breadcrumb-custom {
                margin-bottom: 1rem;
                font-size: 0.8rem;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    @include('admin.partials.sweetalert')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            const mobileMedia = window.matchMedia('(max-width: 991.98px)');

            if (!sidebar || !overlay) {
                return;
            }

            const closeSidebar = function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.classList.remove('sidebar-open');
            };

            const openSidebar = function() {
                sidebar.classList.add('show');
                overlay.classList.add('show');
                document.body.classList.add('sidebar-open');
            };

            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    if (sidebar.classList.contains('show')) {
                        closeSidebar();
                        return;
                    }

                    openSidebar();
                });
            }

            overlay.addEventListener('click', closeSidebar);

            sidebar.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (mobileMedia.matches) {
                        closeSidebar();
                    }
                });
            });

            window.addEventListener('resize', function() {
                if (!mobileMedia.matches) {
                    closeSidebar();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && sidebar.classList.contains('show')) {
                    closeSidebar();
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
