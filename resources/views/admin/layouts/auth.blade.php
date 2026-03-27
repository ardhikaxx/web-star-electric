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
            --secondary: #343a40; /* Assuming a secondary color for login page background */
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: var(--text);
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
            background:
                radial-gradient(circle at top left, rgba(255, 2, 5, 0.16), transparent 28%),
                radial-gradient(circle at bottom right, rgba(245, 158, 11, 0.12), transparent 24%),
                linear-gradient(135deg, #23272f 0%, #161a20 100%);
        }

        /* Styles specific to Login Page, extracted from master.blade.php */
        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: clamp(1rem, 3vw, 2rem);
        }

        .login-card {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 28px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.24);
            width: 100%;
            max-width: 430px;
            padding: clamp(1.4rem, 3.6vw, 2.5rem);
            backdrop-filter: blur(14px);
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.85rem;
        }

        .login-header h2 {
            color: var(--text);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .login-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 15% 18%, rgba(255, 2, 5, 0.18), transparent 18%),
                radial-gradient(circle at 84% 20%, rgba(255, 255, 255, 0.08), transparent 14%),
                radial-gradient(circle at 72% 78%, rgba(245, 158, 11, 0.12), transparent 18%);
        }

        .pin-input {
            display: flex;
            justify-content: center;
            gap: clamp(0.55rem, 2vw, 0.8rem);
            margin-bottom: 1.5rem;
        }

        .pin-input input {
            flex: 1 1 0;
            width: 100%;
            max-width: 64px;
            height: clamp(60px, 9vw, 72px);
            text-align: center;
            font-size: clamp(1.4rem, 3.4vw, 1.75rem);
            font-weight: 700;
            border: 2px solid var(--border);
            border-radius: 18px;
            transition: all 0.2s ease;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbfd 100%);
        }

        .pin-input input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(230, 32, 38, 0.1);
            transform: translateY(-2px);
        }

        .pin-input input.error {
            border-color: var(--danger);
        }

.login-logo {
            width: 180px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            padding: 0;
        }

        .login-logo img {
            width: 100%;
            height: auto;
        }

        /* General styles that should apply to both admin and auth if they are derived from master */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            border-radius: 18px;
            min-height: 56px;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        @media (max-width: 575.98px) {
            .login-card {
                border-radius: 24px;
                padding: 1.25rem;
            }

            .login-logo {
                width: 68px;
                height: 68px;
                border-radius: 22px;
                font-size: 1.7rem;
                margin-bottom: 1.2rem;
            }

            .login-header {
                margin-bottom: 1.5rem;
            }

            .pin-input input {
                max-width: 58px;
                border-radius: 16px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    @include('admin.partials.sweetalert')
    @stack('scripts')
</body>
</html>
