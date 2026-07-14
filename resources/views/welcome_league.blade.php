<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>SMEC Sales Super League 2026</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    @php
        $colorPrimary = \App\Models\Setting::get('brand_color_primary', '#2D318F');
        $colorSecondary = \App\Models\Setting::get('brand_color_secondary', '#0070BC');
        $colorAccent = \App\Models\Setting::get('brand_color_accent', '#00AA9E');
        $logo = \App\Models\Setting::get('logo');
    @endphp

    <style>
        :root {
            --primary: {{ $colorPrimary }};
            --secondary: {{ $colorSecondary }};
            --accent: {{ $colorAccent }};
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-light: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.7);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 2rem 1rem;
            background: linear-gradient(135deg, #0f172a 0%, var(--primary) 100%);
            color: var(--text-light);
            min-height: 100dvh;
            overflow-x: hidden;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        /* Animated glowing background layer */
        .bg-glow {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            overflow: hidden;
            z-index: -1;
        }
        .bg-glow::before, .bg-glow::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.5;
            animation: float 10s infinite alternate ease-in-out;
        }
        .bg-glow::before {
            width: 60vw; height: 60vw;
            background: var(--secondary);
            top: -20%; left: -20%;
        }
        .bg-glow::after {
            width: 50vw; height: 50vw;
            background: var(--accent);
            bottom: -20%; right: -10%;
            animation-delay: -5s;
        }
        @keyframes float {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.2) translate(50px, 50px); }
        }

        .main-container {
            width: 100%;
            height: auto;
            max-width: 600px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            margin: auto;
        }

        .header-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .logo-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 0.5rem 1rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: inline-flex;
        }
        .brand-logo {
            height: 28px;
            object-fit: contain;
        }

        .profile-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            padding: 0.35rem 0.75rem 0.35rem 0.35rem;
            border-radius: 50px;
            backdrop-filter: blur(10px);
        }
        .profile-img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.5);
        }
        .profile-name {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .title-section {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .title {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(2rem, 8vw, 3.5rem);
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.1;
            margin: 0 0 0.5rem 0;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            letter-spacing: -1px;
        }
        .subtitle {
            font-size: clamp(0.85rem, 3vw, 1.1rem);
            color: var(--text-muted);
            margin: 0;
            font-weight: 500;
        }

        /* Glass Cards */
        .glass-panel {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 1.25rem;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 1rem;
        }

        /* Countdown */
        .countdown-grid {
            display: flex;
            gap: 0.5rem;
            justify-content: space-between;
        }
        .countdown-item {
            flex: 1;
            text-align: center;
            background: rgba(0,0,0,0.2);
            border-radius: 12px;
            padding: 0.75rem 0.25rem;
            border: 1px solid rgba(255,255,255,0.05);
            position: relative;
            overflow: hidden;
        }
        .countdown-item::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            background: rgba(255,255,255,0.3);
        }
        .cd-val {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(1.5rem, 5vw, 2.25rem);
            font-weight: 800;
            line-height: 1;
            margin-bottom: 0.25rem;
        }
        .cd-lbl {
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* Urgent status */
        .status-urgent .countdown-item::before { background: #ff4757; }
        .status-urgent .cd-val { color: #ff4757; text-shadow: 0 0 10px rgba(255,71,87,0.4); }
        .status-warn .countdown-item::before { background: #ffa502; }
        .status-warn .cd-val { color: #ffa502; }

        /* Stats */
        .section-lbl {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            text-align: left;
        }
        .stats-grid {
            display: flex;
            gap: 0.5rem;
        }
        .stat-box {
            flex: 1;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
            padding: 0.75rem 0.5rem;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .st-lbl {
            font-size: 0.6rem;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 0.25rem;
            font-weight: 600;
        }
        .st-val {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(1.25rem, 4vw, 1.75rem);
            font-weight: 800;
            line-height: 1;
        }
        .val-primary { color: #ffffff; }
        .val-accent { color: #2ed573; text-shadow: 0 0 10px rgba(46,213,115,0.3); }
        .val-warn { color: #ffa502; }

        .btn-enter {
            background: white;
            color: var(--primary);
            border: none;
            width: 100%;
            padding: 1.2rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 16px;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            margin-top: 0.5rem;
            transition: transform 0.2s;
        }
        .btn-enter:hover {
            transform: translateY(-2px);
            color: var(--primary);
        }
        .btn-enter i {
            margin-left: 0.5rem;
            font-size: 1.3rem;
            transition: transform 0.3s;
        }
        .btn-enter:hover i {
            transform: translateX(5px);
        }

        /* Desktop specific enhancements */
        @media (min-width: 769px) {
            .main-container {
                max-width: 900px;
                padding: 3rem;
                background: var(--glass-bg);
                border: 1px solid var(--glass-border);
                backdrop-filter: blur(20px);
                border-radius: 32px;
                height: auto;
                box-shadow: 0 25px 60px rgba(0,0,0,0.3);
                margin: auto;
            }
            .header-section { justify-content: center; position: relative; margin-bottom: 2rem; }
            .logo-box { position: absolute; left: 0; }
            .profile-badge { position: absolute; right: 0; padding: 0.5rem 1rem 0.5rem 0.5rem; }
            .profile-img { width: 36px; height: 36px; }
            .profile-name { font-size: 1rem; }
            
            .title { font-size: 4rem; margin-bottom: 1rem; }
            .subtitle { font-size: 1.25rem; margin-bottom: 2rem; }
            
            .glass-panel { padding: 2rem; margin-bottom: 1.5rem; }
            .countdown-item { padding: 1.5rem; }
            .cd-val { font-size: 3rem; margin-bottom: 0.5rem; }
            .cd-lbl { font-size: 0.85rem; }
            
            .stats-grid { gap: 1rem; }
            .stat-box { padding: 1.5rem; }
            .st-lbl { font-size: 0.85rem; margin-bottom: 0.5rem; }
            .st-val { font-size: 2.5rem; }
            
            .btn-enter { font-size: 1.25rem; padding: 1.25rem; border-radius: 20px; }
        }

        /* Ultra-small phones (iPhone SE) */
        @media (max-height: 700px) and (max-width: 768px) {
            .main-container { padding: 1rem; justify-content: space-evenly; }
            .header-section { margin-bottom: 0.5rem; }
            .logo-box { padding: 0.35rem 0.75rem; }
            .brand-logo { height: 22px; }
            .title-section { margin-bottom: 0.5rem; }
            .glass-panel { padding: 0.85rem; margin-bottom: 0.5rem; }
            .countdown-item { padding: 0.5rem 0.15rem; }
            .stat-box { padding: 0.5rem 0.25rem; }
            .section-lbl { margin-bottom: 0.4rem; font-size: 0.55rem; }
            .btn-enter { padding: 1rem; margin-top: 0; font-size: 1rem; }
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>

    <div class="main-container">
        <!-- Header -->
        <div class="header-section">
            @if($logo)
            <div class="logo-box">
                <img src="{{ asset('storage/' . $logo) }}" alt="Brand Logo" class="brand-logo">
            </div>
            @endif
            
            <div class="profile-badge">
                @if(Auth::user()->employeeProfile?->photo)
                    <img src="{{ asset('storage/' . Auth::user()->employeeProfile->photo) }}" class="profile-img" alt="Profile">
                @endif
                <span class="profile-name">{{ explode(' ', trim($user->name))[0] }}</span>
            </div>
        </div>

        <!-- Title -->
        <div class="title-section">
            <h1 class="title">Sales Battle '26</h1>
            <p class="subtitle">Every lead counts. Every sale matters.</p>
        </div>

        <!-- Countdown -->
        <div class="glass-panel" id="countdown">
            <div class="section-lbl text-center" style="text-align: center;">Time Remaining</div>
            <div class="countdown-grid">
                <div class="countdown-item"><div class="cd-val" id="days">00</div><div class="cd-lbl">Days</div></div>
                <div class="countdown-item"><div class="cd-val" id="hours">00</div><div class="cd-lbl">Hours</div></div>
                <div class="countdown-item"><div class="cd-val" id="minutes">00</div><div class="cd-lbl">Mins</div></div>
                <div class="countdown-item"><div class="cd-val" id="seconds">00</div><div class="cd-lbl">Secs</div></div>
            </div>
        </div>

        <!-- Stats -->
        <div class="glass-panel">
            <div class="section-lbl">@if($isTeamLeader) My @endif Performance Target</div>
            <div class="stats-grid">
                <div class="stat-box"><div class="st-lbl">Target</div><div class="st-val val-primary">{{ $scoreTarget }}</div></div>
                <div class="stat-box"><div class="st-lbl">Obtained</div><div class="st-val val-accent">{{ $scoreThisMonth }}</div></div>
                <div class="stat-box"><div class="st-lbl">Remaining</div><div class="st-val val-warn">{{ max(0, $scoreTarget - $scoreThisMonth) }}</div></div>
            </div>
        </div>

        @if($isTeamLeader && $team)
        <div class="glass-panel">
            <div class="section-lbl">{{ $team->name }} Target</div>
            <div class="stats-grid">
                <div class="stat-box"><div class="st-lbl">Target</div><div class="st-val val-primary">{{ $teamTarget }}</div></div>
                <div class="stat-box"><div class="st-lbl">Obtained</div><div class="st-val val-accent">{{ $teamScoreThisMonth }}</div></div>
                <div class="stat-box"><div class="st-lbl">Remaining</div><div class="st-val val-warn">{{ max(0, $teamTarget - $teamScoreThisMonth) }}</div></div>
            </div>
        </div>
        @endif

        <a href="{{ route('dashboard') }}" class="btn-enter">
            Enter the Arena <i class="bi bi-arrow-right-short"></i>
        </a>
    </div>

    <script>
        function getEndOfMonth() {
            const now = new Date();
            return new Date(now.getFullYear(), now.getMonth() + 1, 0, 23, 59, 59);
        }

        function updateCountdown() {
            const now = new Date();
            const diff = getEndOfMonth() - now;
            
            const cd = document.getElementById('countdown');
            if (!cd) return;

            if (diff <= 0) {
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
                return;
            }

            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const m = Math.floor((diff / 1000 / 60) % 60);
            const s = Math.floor((diff / 1000) % 60);

            document.getElementById('days').textContent = d.toString().padStart(2, '0');
            document.getElementById('hours').textContent = h.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = m.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = s.toString().padStart(2, '0');

            cd.classList.remove('status-urgent', 'status-warn');
            if (d <= 2) {
                cd.classList.add('status-urgent');
            } else if (d <= 5) {
                cd.classList.add('status-warn');
            }
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>
</body>
</html>
