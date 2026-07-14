<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Power Play</title>

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
        }

        .split-layout {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        @media (min-width: 992px) {
            .split-layout {
                flex-direction: row;
            }
        }

        .left-pane {
            background: linear-gradient(135deg, #2D318F 0%, #0070BC 50%, #00AA9E 100%);
            position: relative;
            padding: 2rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            flex: 1;
        }

        @media (min-width: 992px) {
            .split-layout {
                height: 100vh;
                overflow: hidden;
            }
            .left-pane {
                flex: 0 0 55%;
                padding: 3rem 4rem;
                overflow-y: auto;
            }
        }

        .right-pane {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            flex: 1;
        }

        @media (min-width: 992px) {
            .right-pane {
                flex: 0 0 45%;
                padding: 3rem 4rem;
                overflow-y: auto;
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
        }

        .leaderboard-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .leaderboard-item:last-child {
            border-bottom: none;
        }

        .auth-form-container {
            width: 100%;
            max-width: 420px;
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
            max-width: 220px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="split-layout">
        <!-- Left Pane: Leaderboard & Stats -->
        <div class="left-pane">
            <div style="max-width: 600px; margin: 0 auto; width: 100%;">
                <h1 class="fw-bolder mb-1" style="font-size: 2.5rem; letter-spacing: -1px;">Sales Surge</h1>
                <p class="fs-6 mb-4 opacity-75">This Month's Scorecard</p>

                <div class="row g-3">
                    <div class="col-12 col-xl-7">
                        <div class="glass-card h-100 mb-0">
                            <h5 class="fw-bold mb-3 d-flex align-items-center"><i class="bi bi-trophy-fill text-warning me-2"></i> Top 3 Performers</h5>
                            <ul class="leaderboard-list">
                                @foreach(array_slice($topEmployees ?? [], 0, 3) as $index => $emp)
                                    <li class="leaderboard-item py-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="fw-bold fs-6 opacity-75" style="width: 20px;">#{{ $index + 1 }}</span>
                                            <div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                                {{ strtoupper(substr($emp->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold fs-6" style="line-height: 1.2;">{{ $emp->name }}</div>
                                                <div class="small opacity-75" style="font-size: 0.7rem;">{{ $emp->designation ?? 'Sales Executive' }}</div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-bolder text-warning">{{ $emp->score }}</div>
                                            <div class="small text-uppercase opacity-75" style="font-size: 0.6rem; letter-spacing: 1px;">Pts</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-12 col-xl-5">
                        <div class="d-flex flex-column gap-3 h-100">
                            <div class="mb-1"><h5 class="fw-bold mb-0"><i class="bi bi-people-fill text-info me-2"></i> Top Teams</h5></div>
                            @foreach(array_slice($topTeams ?? [], 0, 3) as $index => $team)
                                <div class="glass-card p-3 mb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="small text-uppercase opacity-75 fw-semibold" style="letter-spacing: 1px; font-size: 0.65rem;">#{{ $index + 1 }} Team</div>
                                        <div class="fw-bold text-truncate" style="max-width: 120px;" title="{{ $team->name }}">{{ $team->name }}</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="fs-5 fw-bolder text-warning">{{ $team->score }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Pane: Login Form -->
        <div class="right-pane">
            <div class="auth-form-container">
                <div class="text-center">
                    <img src="{{ asset('images/logo-new.webp') }}" alt="SMEC Labs" class="brand-logo">
                </div>

                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark mb-1">Welcome Back</h3>
                    <p class="text-muted">Enter your credentials to access your dashboard.</p>
                </div>

                @if(session('status'))
                    <div class="alert alert-info rounded-3 border-0 bg-info bg-opacity-10 text-info p-3 mb-4 small fw-medium" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold text-secondary">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control @error('email') is-invalid @enderror" placeholder="name@company.com">
                        @error('email')
                            <div class="invalid-feedback fw-medium mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold text-secondary">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback fw-medium mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-5 d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" id="remember_me" name="remember" style="width: 1.25rem; height: 1.25rem; margin-top: 0;">
                        <label class="form-check-label ms-2 text-secondary fw-medium" for="remember_me">
                            Keep me logged in
                        </label>
                    </div>

                    <button type="submit" class="btn btn-brand w-100 shadow-sm">
                        Sign In <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
