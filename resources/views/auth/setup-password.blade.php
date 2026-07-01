<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Set Password - Power Play</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .auth-form-container {
            width: 100%;
            max-width: 480px;
            background-color: #ffffff;
            padding: 3rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .form-control {
            border-radius: 12px;
            padding: 0.85rem 1.25rem;
            border: 2px solid #e9ecef;
            background-color: #f8f9fa;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #00AA9E;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(0, 170, 158, 0.15);
        }

        .btn-brand {
            background: linear-gradient(135deg, #2D318F 0%, #00AA9E 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.85rem;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 170, 158, 0.3);
            color: white;
        }

        .brand-logo {
            max-width: 180px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="auth-form-container">
        <div class="text-center">
            <img src="{{ asset('images/logo-new.webp') }}" alt="SMEC Labs" class="brand-logo">
        </div>

        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark mb-1">Set Your Password</h3>
            <p class="text-muted small">For your security, please replace your temporary password with a new, permanent password.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 border-0 bg-danger bg-opacity-10 text-danger p-3 mb-4 small fw-medium">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.setup.store') }}">
            @csrf
            
            <div class="mb-4">
                <label for="password" class="form-label fw-semibold text-secondary">New Password</label>
                <input id="password" type="password" name="password" required autofocus class="form-control" placeholder="••••••••">
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="form-label fw-semibold text-secondary">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control" placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-brand w-100 shadow-sm">
                Save and Continue <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </form>
    </div>
</body>
</html>
