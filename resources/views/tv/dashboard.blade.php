<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live TV Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800;900&display=swap');
        
        /* Dynamically scale the entire dashboard to fit the screen height perfectly */
        html {
            font-size: clamp(10px, 1.4vh, 20px);
        }
        
        :root {
            --brand-teal: #00aa9e;
            --brand-blue: #0070bc;
            --brand-indigo: #2f3092;
            --bg-gradient: linear-gradient(135deg, #e0e7ff 0%, #cffafe 100%);
        }

        body {
            background: var(--bg-gradient);
            color: #0f172a;
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            overflow: hidden; 
        }

        #app {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 2rem;
            position: relative;
            z-index: 1;
            height: 100vh;
        }

        /* Ambient Orbs */
        .ambient-orb-1 {
            position: absolute; top: -10%; left: -10%; width: 50vw; height: 50vw;
            background: #d8b4fe; filter: blur(150px); opacity: 0.4; z-index: -1;
        }
        .ambient-orb-2 {
            position: absolute; bottom: -10%; right: -10%; width: 50vw; height: 50vw;
            background: #99f6e4; filter: blur(150px); opacity: 0.4; z-index: -1;
        }

        .header-panel {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 1.5rem;
            padding: 1rem 2rem;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            flex: 0 0 auto;
        }

        .dashboard-card {
            background: #ffffff;
            border-radius: 1.5rem;
            box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .hero-section {
            background: #ffffff;
            padding: 1.5rem;
            flex: 0 0 auto;
            position: relative;
        }

        .list-section {
            background: #f4f6f9; /* The gray bottom area from the design */
            padding: 1.5rem 2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            gap: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .badge-mvp {
            background: var(--brand-teal);
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
            letter-spacing: 0.05rem;
        }
        
        .badge-team {
            background: var(--brand-indigo);
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
            letter-spacing: 0.05rem;
        }

        .hero-avatar {
            width: 10rem;
            height: 10rem;
            border: 4px solid var(--brand-teal);
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(0, 170, 158, 0.4);
        }

        .hero-icon {
            width: 10rem;
            height: 10rem;
            border: 4px solid var(--brand-indigo);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            color: var(--brand-teal);
            box-shadow: 0 0 15px rgba(47, 48, 146, 0.4);
        }

        .hero-score-pill-teal {
            background: rgba(0, 170, 158, 0.1);
            border: 1px solid rgba(0, 170, 158, 0.3);
            color: var(--brand-teal);
            padding: 0.25rem 1.25rem;
        }

        .hero-score-pill-blue {
            background: rgba(0, 112, 188, 0.1);
            border: 1px solid rgba(0, 112, 188, 0.3);
            color: var(--brand-blue);
            padding: 0.25rem 1.25rem;
        }

        .list-item {
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 1rem; /* pill-like */
            padding: 0.75rem 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.03);
            border: 1px solid transparent;
        }

        .rank-number {
            font-size: 1.25rem;
            font-weight: 900;
            font-style: italic;
            color: #94a3b8;
            margin-right: 1.5rem;
            width: 2rem;
            text-align: center;
        }

        .list-avatar {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
            background: #e2e8f0;
        }

        .list-score-teal {
            background: rgba(0, 170, 158, 0.1);
            border: 1px solid rgba(0, 170, 158, 0.2);
            color: var(--brand-teal);
            border-radius: 1rem;
            padding: 0.25rem 1rem;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .list-score-blue {
            background: rgba(0, 112, 188, 0.1);
            border: 1px solid rgba(0, 112, 188, 0.2);
            color: var(--brand-blue);
            border-radius: 1rem;
            padding: 0.25rem 1rem;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* NEW COLOR ANIMATIONS */
        @keyframes subtle-gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .list-item {
            background: linear-gradient(120deg, #ffffff, #f8fafc, #ffffff);
            background-size: 200% 200%;
            animation: subtle-gradient 6s ease infinite;
            display: flex;
            align-items: center;
            border-radius: 1rem;
            padding: 0.75rem 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.03);
            border: 1px solid transparent;
        }

        @keyframes pulse-glow-teal {
            0% { box-shadow: 0 0 0 0 rgba(0, 170, 158, 0.5); }
            70% { box-shadow: 0 0 0 15px rgba(0, 170, 158, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 170, 158, 0); }
        }
        @keyframes pulse-glow-blue {
            0% { box-shadow: 0 0 0 0 rgba(0, 112, 188, 0.5); }
            70% { box-shadow: 0 0 0 15px rgba(0, 112, 188, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 112, 188, 0); }
        }
        .hero-avatar, .list-score-teal, .hero-score-pill-teal {
            animation: pulse-glow-teal 2.5s infinite;
        }
        .hero-icon, .list-score-blue, .hero-score-pill-blue {
            animation: pulse-glow-blue 2.5s infinite;
        }

        .list-item.recent-gain {
            background: #dcfce7 !important; /* Light green background */
            border: 2px solid #22c55e !important;
            animation: none;
            transition: all 0.5s ease;
        }
        @keyframes bounceIn {
            0% { transform: scale(0.1); opacity: 0; }
            60% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); }
        }
        .bounce-anim {
            animation: bounceIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: #16a34a !important;
        }

        #notification-overlay {
            transform: translateY(-150%);
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: fixed;
            top: 2rem;
            left: 50%;
            transform: translateX(-50%) translateY(-150%);
            z-index: 9999;
            width: 90%;
            max-width: 50rem;
        }
        #notification-overlay.show {
            transform: translateX(-50%) translateY(0);
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <!-- Auth Overlay (One-time per device) -->
    <div id="auth-overlay" style="position: fixed; inset: 0; background: rgba(241, 245, 249, 0.98); backdrop-filter: blur(20px); z-index: 99999; display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <div class="dashboard-card" style="padding: 3rem; text-align: center; max-width: 400px; height: auto;">
            <i class="bi bi-tv text-dark" style="font-size: 4rem; margin-bottom: 1rem;"></i>
            <h2 class="fw-black text-dark mb-4" style="letter-spacing: 0.1rem;">TV Access</h2>
            <input type="password" id="tv-password" class="form-control form-control-lg mb-3 text-center fw-bold" placeholder="Enter Access Code">
            <button onclick="verifyTvPassword()" class="btn btn-dark btn-lg w-100 fw-bold rounded-pill" style="background: var(--brand-indigo);">Unlock Dashboard</button>
            <p id="auth-error" class="text-danger mt-3 fw-bold d-none">Incorrect password.</p>
        </div>
    </div>

    <!-- Ambient Background -->
    <div class="ambient-orb-1"></div>
    <div class="ambient-orb-2"></div>

    <!-- Top Scorer MVP Celebration Overlay (Triggers every 15 mins) -->
    <div id="mvp-celebration-overlay" class="d-flex flex-column align-items-center justify-content-center" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(20px); z-index: 100000; opacity: 0; pointer-events: none; transition: opacity 1s ease;">
        <div id="mvp-celebration-content" style="transform: scale(0.5); transition: transform 1s cubic-bezier(0.34, 1.56, 0.64, 1); text-align: center;">
            <span class="badge rounded-pill mb-4" style="font-size: 1.5rem; padding: 1rem 3rem; background: linear-gradient(135deg, var(--brand-teal), var(--brand-blue)); box-shadow: 0 0 30px rgba(0,170,158,0.5);">
                <i class="bi bi-star-fill text-warning me-2"></i> CURRENT MVP <i class="bi bi-star-fill text-warning ms-2"></i>
            </span>
            <br>
            <img src="/images/default-avatar.png" id="mvp-celebration-image" style="width: 25rem; height: 25rem; border: 8px solid var(--brand-teal); object-fit: cover; border-radius: 50%; box-shadow: 0 0 50px rgba(0, 170, 158, 0.8); margin-bottom: 2rem;">
            <h1 class="fw-black text-white text-uppercase" id="mvp-celebration-name" style="font-size: 4rem; text-shadow: 0 5px 15px rgba(0,0,0,0.5);">Loading...</h1>
            <div class="fw-bold text-uppercase mt-2" id="mvp-celebration-team" style="color: #94a3b8; letter-spacing: 0.3rem; font-size: 1.5rem;">Team</div>
        </div>
    </div>

    <div id="app">
        
        <!-- Header Panel -->
        <header class="header-panel d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <img src="/images/logo-new.webp" alt="SMEClabs" style="height: 3.5rem; width: auto; object-fit: contain;">
                <div>
                    <h1 class="m-0 fw-black text-dark text-uppercase" style="font-size: 1.75rem; letter-spacing: 0.1rem;">Live Leaderboard</h1>
                    <p class="m-0 text-uppercase fw-bold" style="color: #64748b; font-size: 0.75rem; letter-spacing: 0.2rem;">Real-Time Performance Analytics</p>
                </div>
            </div>
            <div class="text-end">
                <div class="fw-black text-dark" id="clock" style="font-size: 2rem; font-feature-settings: 'tnum'; font-variant-numeric: tabular-nums; line-height: 1;">00:00:00</div>
                <div class="text-uppercase fw-bold mt-1" id="date" style="color: #64748b; font-size: 0.75rem; letter-spacing: 0.15rem;">Loading...</div>
            </div>
        </header>

        <!-- Main Content Area: Exactly matching the provided design -->
        <div class="row flex-grow-1 gx-4 overflow-hidden">
            
            <!-- Left Side: Performers -->
            <div class="col-12 col-xl-6 d-flex flex-column">
                <div class="dashboard-card">
                    <!-- Hero Section -->
                    <div class="hero-section d-flex align-items-center">
                        <span class="badge rounded-pill badge-mvp position-absolute top-0 end-0 m-4">
                            <i class="bi bi-lightning-fill"></i> MVP
                        </span>
                        
                        <img src="/images/default-avatar.png" id="top-performer-image" class="hero-avatar flex-shrink-0">
                        
                        <div class="ms-4 flex-grow-1">
                            <div class="fw-bold text-uppercase mb-1" id="top-performer-team" style="color: #64748b; letter-spacing: 0.15rem; font-size: 0.75rem;">Loading...</div>
                            <h2 class="fw-black text-dark mb-2 text-truncate" id="top-performer-name" style="font-size: 2.25rem;">Loading...</h2>
                            <div class="d-inline-flex align-items-baseline rounded-pill hero-score-pill-teal">
                                <span class="fw-black" id="top-performer-score" style="font-size: 2.5rem; line-height: 1;">0</span>
                                <span class="fw-bold ms-2" style="font-size: 0.9rem;">RUNS</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Next Performers List -->
                    <div class="list-section" id="performers-list">
                        <!-- JS Injected -->
                    </div>
                </div>
            </div>

            <!-- Right Side: Teams -->
            <div class="col-12 col-xl-6 d-flex flex-column">
                <div class="dashboard-card">
                    <!-- Hero Section -->
                    <div class="hero-section d-flex align-items-center">
                        <span class="badge rounded-pill badge-team position-absolute top-0 end-0 m-4">
                            <i class="bi bi-trophy-fill"></i> TOP TEAM
                        </span>
                        
                        <!-- Captain Avatar replacing Trophy icon -->
                        <div class="text-center flex-shrink-0">
                            <img src="/images/default-avatar.png" id="top-team-captain-image" class="hero-avatar mb-2" style="border-color: var(--brand-indigo); width: 6.5rem; height: 6.5rem;">
                            <div class="fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.15rem; color: #64748b;">CAPTAIN</div>
                            <div class="fw-bold text-dark text-truncate" id="top-team-captain-name" style="font-size: 1.1rem; max-width: 10rem;">Loading...</div>
                        </div>
                        
                        <div class="ms-4 flex-grow-1 overflow-hidden">
                            <div class="fw-bold text-uppercase mb-1" style="color: #64748b; letter-spacing: 0.15rem; font-size: 0.75rem;">Leading Team</div>
                            <h2 class="fw-black text-dark mb-2 text-truncate" id="top-team-name" style="font-size: 2.25rem;">Loading...</h2>
                            <div class="d-inline-flex align-items-baseline rounded-pill hero-score-pill-blue mb-2">
                                <span class="fw-black" id="top-team-score" style="font-size: 2.5rem; line-height: 1;">0</span>
                                <span class="fw-bold ms-2" style="font-size: 0.9rem;">RUNS</span>
                            </div>
                            <div class="text-truncate text-muted fw-normal" id="top-team-members" style="font-size: 0.8rem;"></div>
                        </div>
                    </div>
                    
                    <!-- Next Teams List -->
                    <div class="list-section" id="teams-list">
                        <!-- JS Injected -->
                    </div>
                </div>
            </div>

        </div>

        <!-- Notification Overlay -->
        <div id="notification-overlay" class="header-panel d-flex align-items-center gap-4 m-0 border border-3" style="border-color: var(--brand-teal) !important;">
            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 4rem; height: 4rem; background: var(--brand-teal);">
                <i class="bi bi-bell-fill text-white fs-2"></i>
            </div>
            <div class="flex-grow-1">
                <h3 class="fw-black text-dark mb-1 text-uppercase fs-4" style="letter-spacing: 0.1rem;">Score Update!</h3>
                <p class="m-0 text-dark fs-5 opacity-75" id="notification-text">Someone scored!</p>
            </div>
        </div>

    </div>

    <script>
        // TV Authentication Logic
        function verifyTvPassword() {
            if (document.getElementById('tv-password').value === 'smectv') {
                localStorage.setItem('tv_auth_unlocked', 'true');
                document.getElementById('auth-overlay').style.display = 'none';
                initAudio(); // Enables audio because it's tied to a user click
            } else {
                document.getElementById('auth-error').classList.remove('d-none');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            if (localStorage.getItem('tv_auth_unlocked') === 'true') {
                document.getElementById('auth-overlay').style.display = 'none';
            }
            var input = document.getElementById("tv-password");
            if (input) {
                input.addEventListener("keypress", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        verifyTvPassword();
                    }
                });
            }
        });

        function updateClock() {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString('en-US', { hour12: true });
            document.getElementById('date').innerText = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        }
        setInterval(updateClock, 1000);
        updateClock();

        let audioCtx;
        function initAudio() {
            if (!audioCtx) {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
        }

        function playTone(freq, startTime, duration) {
            try {
                const osc = audioCtx.createOscillator();
                const gainNode = audioCtx.createGain();
                osc.type = 'sine';
                osc.frequency.value = freq;
                
                gainNode.gain.setValueAtTime(0, startTime);
                gainNode.gain.linearRampToValueAtTime(0.5, startTime + 0.05);
                gainNode.gain.exponentialRampToValueAtTime(0.001, startTime + duration);
                
                osc.connect(gainNode);
                gainNode.connect(audioCtx.destination);
                
                osc.start(startTime);
                osc.stop(startTime + duration);
            } catch(e) {}
        }

        function playNotificationSound() {
            try {
                if (!audioCtx) return; 
                if (audioCtx.state === 'suspended') audioCtx.resume();
                const now = audioCtx.currentTime;
                playTone(659.25, now, 1.0);       // E5
                playTone(523.25, now + 0.2, 1.5); // C5
            } catch(e) {}
        }

        function triggerConfetti() {
            confetti({
                particleCount: 200,
                spread: 100,
                origin: { y: 0.1 },
                colors: ['#00aa9e', '#0070bc', '#2f3092', '#ffffff'],
                zIndex: 100,
                ticks: 300
            });
        }

        var notificationTimeout;
        function showNotification(activity) {
            playNotificationSound();
            triggerConfetti();

            const textEl = document.getElementById('notification-text');
            const overlay = document.getElementById('notification-overlay');
            
            const employeeName = activity.employee ? activity.employee.name : 'Someone';
            const score = activity.score || 0;
            const teamName = activity.team ? activity.team.name : '';
            
            textEl.innerHTML = `<span class="fw-bold" style="color: var(--brand-teal);">${employeeName}</span> ${teamName ? `<span class="opacity-50">(${teamName})</span>` : ''} scored <span class="badge text-white ms-2" style="background: var(--brand-teal);">+${score} RUNS</span>`;
            
            overlay.classList.add('show');
            
            clearTimeout(notificationTimeout);
            notificationTimeout = setTimeout(() => {
                overlay.classList.remove('show');
            }, 6000);
        }

        var lastActivityId = null;
        var initialData = {!! $initialData !!};
        var currentData = initialData;
        var displayedActivities = new Set();
        var recentGains = { performers: {}, teams: {} };

        function renderDashboard(data) {
            currentData = data;
            if (data.latestActivities && data.latestActivities.length > 0) {
                var activitiesByEmployee = {};
                var hasNew = false;
                
                for (var i = 0; i < data.latestActivities.length; i++) {
                    var act = data.latestActivities[i];
                    if (displayedActivities.has(act.id)) continue;
                    displayedActivities.add(act.id);
                    hasNew = true;

                    var empId = act.employee_id ? act.employee_id : (act.employee ? act.employee.id : null);
                    var teamId = act.team_id ? act.team_id : (act.team ? act.team.id : null);
                    
                    if (empId) {
                        if (!recentGains.performers[empId]) recentGains.performers[empId] = { amount: 0, timestamp: Date.now() };
                        recentGains.performers[empId].amount += parseFloat(act.score || 0);
                        recentGains.performers[empId].timestamp = Date.now();

                        if (!activitiesByEmployee[empId]) {
                            activitiesByEmployee[empId] = {
                                employee: act.employee,
                                team: act.team,
                                score: 0
                            };
                        }
                        activitiesByEmployee[empId].score += parseFloat(act.score || 0);
                    }

                    if (teamId) {
                        if (!recentGains.teams[teamId]) recentGains.teams[teamId] = { amount: 0, timestamp: Date.now() };
                        recentGains.teams[teamId].amount += parseFloat(act.score || 0);
                        recentGains.teams[teamId].timestamp = Date.now();
                    }
                }

                if (hasNew) {
                    var firstEmpId = Object.keys(activitiesByEmployee)[0];
                    if (firstEmpId) {
                        showNotification(activitiesByEmployee[firstEmpId]);
                    }
                }
            }

            if (data.lastActivityId) {
                lastActivityId = data.lastActivityId;
            }

            // Update Top Performer Hero
            if (data.topPerformer) {
                var userProfile = data.topPerformer.employee_profile || data.topPerformer.employeeProfile;
                var userImgUrl = (userProfile && userProfile.photo) 
                    ? '/storage/' + userProfile.photo 
                    : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(data.topPerformer.name) + '&background=e2e8f0&color=0f172a';
                
                document.getElementById('top-performer-image').src = userImgUrl;
                document.getElementById('top-performer-name').innerText = data.topPerformer.name;
                document.getElementById('top-performer-score').innerText = data.topPerformer.activities_sum_score || 0;
                document.getElementById('top-performer-team').innerText = (data.topPerformer.teams && data.topPerformer.teams.length > 0) ? data.topPerformer.teams[0].name : '';
            }

            // Update Performers List (2 to 5)
            if (data.otherPerformers) {
                var performersList = document.getElementById('performers-list');
                performersList.innerHTML = '';
                
                for (var j = 0; j < data.otherPerformers.length; j++) {
                    var user = data.otherPerformers[j];
                    var rank = j + 2; 
                    var userProfile = user.employee_profile || user.employeeProfile;
                    var userImgUrl = (userProfile && userProfile.photo) 
                        ? '/storage/' + userProfile.photo 
                        : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(user.name) + '&background=e2e8f0&color=0f172a';
                    
                    var gainData = recentGains.performers[user.id];
                    var isGreen = (gainData && (Date.now() - gainData.timestamp < 15000));
                    var gainBadge = isGreen ? '<span class="text-success fw-black ms-2 bounce-anim" style="font-size:1.1rem;">+' + gainData.amount + '</span>' : '';

                    var el = document.createElement('div');
                    el.className = 'list-item py-2 ' + (isGreen ? 'recent-gain' : '');
                    
                    el.innerHTML = '<div class="rank-number">0' + rank + '</div>' +
                        '<img src="' + userImgUrl + '" class="list-avatar flex-shrink-0">' +
                        '<div class="flex-grow-1 text-truncate fw-bold text-dark fs-5">' + user.name + '</div>' +
                        '<div class="list-score-teal flex-shrink-0 d-flex align-items-center">' + (user.activities_sum_score || 0) + ' <span style="font-size: 0.75em; opacity: 0.8;" class="ms-1">RUNS</span>' + gainBadge + '</div>';
                    
                    performersList.appendChild(el);
                }
            }

            // Update Top Team Hero
            if (data.topTeam) {
                document.getElementById('top-team-name').innerText = data.topTeam.name;
                document.getElementById('top-team-score').innerText = data.topTeam.activities_sum_score || 0;

                var captain = (data.topTeam.leaders && data.topTeam.leaders.length > 0) ? data.topTeam.leaders[0] : null;
                if (captain) {
                    var capProfile = captain.employee_profile || captain.employeeProfile;
                    var capImgUrl = (capProfile && capProfile.photo) 
                        ? '/storage/' + capProfile.photo 
                        : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(captain.name) + '&background=e2e8f0&color=0f172a';
                    document.getElementById('top-team-captain-image').src = capImgUrl;
                    document.getElementById('top-team-captain-name').innerText = captain.name;
                } else {
                    document.getElementById('top-team-captain-image').src = 'https://ui-avatars.com/api/?name=TBD&background=e2e8f0&color=0f172a';
                    document.getElementById('top-team-captain-name').innerText = 'Unassigned';
                }
                var membersStr = (data.topTeam.users && data.topTeam.users.length > 0) 
                    ? data.topTeam.users.filter(function(u) { return !captain || u.id !== captain.id; }).map(function(u){ return u.name; }).join(', ') 
                    : 'No other members';
                document.getElementById('top-team-members').innerText = membersStr;
            }

            // Update Teams List (2 to 5)
            if (data.otherTeams) {
                var teamsList = document.getElementById('teams-list');
                teamsList.innerHTML = '';
                
                for (var k = 0; k < data.otherTeams.length; k++) {
                    var team = data.otherTeams[k];
                    var trank = k + 2;
                    
                    var teamCaptain = (team.leaders && team.leaders.length > 0) ? team.leaders[0] : null;
                    var tCapImg = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(team.name) + '&background=e2e8f0&color=0f172a';
                    var tCapName = team.name;
                    if (teamCaptain) {
                        var tcProfile = teamCaptain.employee_profile || teamCaptain.employeeProfile;
                        tCapImg = (tcProfile && tcProfile.photo) ? '/storage/' + tcProfile.photo : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(teamCaptain.name) + '&background=e2e8f0&color=0f172a';
                        tCapName = team.name + ' <span class="fw-normal text-muted" style="font-size:0.75rem;">(' + teamCaptain.name + ')</span>';
                    }
                    
                    var membersLine = (team.users && team.users.length > 0) 
                        ? team.users.filter(function(u) { return !teamCaptain || u.id !== teamCaptain.id; }).map(function(u){ return u.name; }).join(', ') 
                        : 'No other members';
                        
                    var gainData = recentGains.teams[team.id];
                    var isGreen = (gainData && (Date.now() - gainData.timestamp < 15000));
                    var gainBadge = isGreen ? '<span class="text-success fw-black ms-2 bounce-anim" style="font-size:1.1rem;">+' + gainData.amount + '</span>' : '';
                    
                    var tel = document.createElement('div');
                    tel.className = 'list-item py-2 ' + (isGreen ? 'recent-gain' : '');
                    
                    tel.innerHTML = '<div class="rank-number">0' + trank + '</div>' +
                        '<img src="' + tCapImg + '" class="list-avatar flex-shrink-0" style="width: 2.75rem; height: 2.75rem;">' +
                        '<div class="flex-grow-1 overflow-hidden pe-3">' +
                            '<div class="fw-bold text-dark text-truncate lh-sm" style="font-size: 0.9rem;">' + tCapName + '</div>' +
                            '<div class="text-truncate text-muted fw-normal mt-1" style="font-size: 0.65rem;">' + membersLine + '</div>' +
                        '</div>' +
                        '<div class="list-score-blue flex-shrink-0 d-flex align-items-center">' + (team.activities_sum_score || 0) + ' <span style="font-size: 0.75em; opacity: 0.8;" class="ms-1">RUNS</span>' + gainBadge + '</div>';
                    
                    teamsList.appendChild(tel);
                }
            }
        }

        renderDashboard(initialData);

        function fetchDashboardData() {
            var url = '/tv/data?_t=' + new Date().getTime() + (lastActivityId !== null ? '&last_activity_id=' + lastActivityId : '');
            fetch(url)
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    renderDashboard(data);
                })
                .catch(function(error) {
                    console.error("Error fetching dashboard data:", error);
                });
        }

        setInterval(fetchDashboardData, 3000);

        // --- MVP Celebration Logic ---
        function triggerMvpCelebration() {
            if (!currentData || !currentData.topPerformer) return;
            
            var topPerf = currentData.topPerformer;
            var userProfile = topPerf.employee_profile || topPerf.employeeProfile;
            var userImgUrl = (userProfile && userProfile.photo) 
                ? '/storage/' + userProfile.photo 
                : 'https://ui-avatars.com/api/?name=' + encodeURIComponent(topPerf.name) + '&background=e2e8f0&color=0f172a';
            
            document.getElementById('mvp-celebration-image').src = userImgUrl;
            document.getElementById('mvp-celebration-name').innerText = topPerf.name;
            document.getElementById('mvp-celebration-team').innerText = (topPerf.teams && topPerf.teams.length > 0) ? topPerf.teams[0].name : '';

            var overlay = document.getElementById('mvp-celebration-overlay');
            var content = document.getElementById('mvp-celebration-content');
            
            overlay.style.opacity = '1';
            content.style.transform = 'scale(1)';
            
            // Celebration Sound & Confetti Loop
            playNotificationSound();
            var duration = 5 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 100001 };
            
            var interval = setInterval(function() {
                var timeLeft = animationEnd - Date.now();
                if (timeLeft <= 0) return clearInterval(interval);
                var particleCount = 50 * (timeLeft / duration);
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: Math.random() * 0.2 + 0.1, y: Math.random() - 0.2 } }));
                confetti(Object.assign({}, defaults, { particleCount, origin: { x: Math.random() * 0.2 + 0.7, y: Math.random() - 0.2 } }));
            }, 250);

            // Auto-close after 8 seconds
            setTimeout(function() {
                overlay.style.opacity = '0';
                content.style.transform = 'scale(0.5)';
            }, 8000);
        }

        // Run every 15 minutes (900,000 milliseconds)
        setInterval(triggerMvpCelebration, 900000);

        // Hidden shortcut for testing: Press 'C' to trigger instantly
        document.addEventListener('keydown', function(e) {
            if(e.key.toLowerCase() === 'c') triggerMvpCelebration();
        });

    </script>
</body>
</html>
