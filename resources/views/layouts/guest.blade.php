<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - SMEC SPMS</title>

    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2D318F 0%, #0070BC 50%, #00AA9E 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 24px;
            box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.15);
            color: #ffffff;
            width: 100%;
            max-width: 450px;
            padding: 3rem 2.5rem;
            animation: slideUp 0.6s ease forwards;
        }

        .auth-card input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .auth-card input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ffffff;
            color: #ffffff;
            box-shadow: none;
        }

        .auth-card input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .auth-card label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .auth-card .btn-submit {
            background-color: #ffffff;
            color: #2D318F;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 600;
            border: none;
            transition: all 0.2s ease;
        }

        .auth-card .btn-submit:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <!-- PWA Setup -->
    {!! app(\EragLaravelPwa\Services\PWAService::class)->headTag() !!}
</head>
<body>
    <div class="auth-card">
        {{ $slot }}
    </div>

    <!-- PWA Service Worker -->
    {!! app(\EragLaravelPwa\Services\PWAService::class)->registerServiceWorkerScript() !!}
</body>
</html>
