<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SPMS - SMEC Labs</title>

    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Dynamic Theme Styling Injection -->
    <style>
        :root {
            --primary-color: {{ \App\Models\Setting::get('brand_color_primary', '#2D318F') }};
            --secondary-color: {{ \App\Models\Setting::get('brand_color_secondary', '#0070BC') }};
            --accent-color: {{ \App\Models\Setting::get('brand_color_accent', '#00AA9E') }};
        }
    </style>

    <!-- PWA Setup -->
    {!! app(\EragLaravelPwa\Services\PWAService::class)->headTag() !!}
</head>
<body class="font-sans antialiased">
    <!-- Dark Mode Initial Verification -->
    <script>
        if (localStorage.getItem('dark-mode') === 'true') {
            document.body.classList.add('dark-mode');
        }
    </script>

    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column" id="sidebar">
        <div class="d-flex align-items-center justify-content-between p-4 border-bottom border-light flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none gap-2">
                @php
                    $logo = \App\Models\Setting::get('logo');
                @endphp
                @if($logo)
                    <img src="{{ asset('storage/' . $logo) }}" alt="SMEC Logo" height="35" class="rounded">
                @else
                    <span class="fs-4 fw-bold" style="color: var(--primary-color);">SMEC</span>
                    <span class="fs-4 fw-bold" style="color: var(--accent-color);">SPMS</span>
                @endif
            </a>
            <button class="btn d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-x-lg text-secondary fs-5"></i>
            </button>
        </div>

        <div class="py-4 flex-grow-1 overflow-y-auto" style="scrollbar-width: thin;">
            <nav class="nav flex-column mb-4">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 fs-5"></i>
                    <span>Dashboard</span>
                </a>

                <a class="nav-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}" href="{{ route('leaderboard') }}">
                    <i class="bi bi-trophy-fill fs-5"></i>
                    <span>Leaderboard</span>
                </a>

                <a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                    <i class="bi bi-bar-chart-line-fill fs-5"></i>
                    <span>Reports</span>
                </a>

                @role('Super Admin|Sales Head (HOD)')
                <hr class="mx-3 text-secondary my-3 opacity-25">
                <div class="px-4 mb-2 text-uppercase text-secondary font-monospace" style="font-size: 0.7rem;">Management</div>

                <a class="nav-link {{ request()->routeIs('past-activities.*') ? 'active' : '' }}" href="{{ route('past-activities.create') }}">
                    <i class="bi bi-clock-history fs-5"></i>
                    <span>Past Activities</span>
                </a>

                <a class="nav-link {{ request()->routeIs('activities-manage.*') ? 'active' : '' }}" href="{{ route('activities-manage.index') }}">
                    <i class="bi bi-pencil-square fs-5"></i>
                    <span>Manage Activities</span>
                </a>

                <a class="nav-link {{ request()->routeIs('teams.*') ? 'active' : '' }}" href="{{ route('teams.index') }}">
                    <i class="bi bi-people-fill fs-5"></i>
                    <span>Teams</span>
                </a>

                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-person-badge-fill fs-5"></i>
                    <span>Employees</span>
                </a>

                <a class="nav-link {{ request()->routeIs('target-settings.*') ? 'active' : '' }}" href="{{ route('target-settings.index') }}">
                    <i class="bi bi-bullseye fs-5"></i>
                    <span>Target Settings</span>
                </a>

                <a class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}" href="{{ route('settings.index') }}">
                    <i class="bi bi-gear-fill fs-5"></i>
                    <span>Settings</span>
                </a>
                @endrole

                @role('Super Admin')
                <hr class="mx-3 text-secondary my-3 opacity-25">
                <div class="px-4 mb-2 text-uppercase text-secondary font-monospace" style="font-size: 0.7rem;">Analytics</div>
                <a class="nav-link {{ request()->routeIs('admin.performance.*') ? 'active' : '' }}" href="{{ route('admin.performance.index') }}">
                    <i class="bi bi-graph-up fs-5"></i>
                    <span>Performance</span>
                </a>
                @endrole
            </nav>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="main-wrapper">
        <!-- Sticky Header -->
        <header class="sticky-header shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-4"></i>
                </button>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Real-time Clock -->
                <div class="d-flex align-items-center text-muted small bg-light px-2 px-md-3 py-1 py-md-1.5 rounded-pill border">
                    <i class="bi bi-clock me-1 me-md-2 text-primary"></i> 
                    <span id="realtimeClock" class="fw-semibold font-monospace" style="font-size: 0.8rem;"></span>
                </div>

                <!-- Dark Mode Toggler -->
                <button class="btn btn-light rounded-circle" onclick="toggleDarkMode()" title="Toggle Dark/Light Mode">
                    <i class="bi bi-moon-fill" id="darkModeIcon"></i>
                </button>

                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light d-flex align-items-center gap-2 border shadow-sm py-2 px-3 rounded-pill dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->employeeProfile?->photo)
                            <img src="{{ asset('storage/' . Auth::user()->employeeProfile->photo) }}" alt="Avatar" width="30" height="30" class="rounded-circle object-fit-cover">
                        @else
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        @endif
                        <span class="d-none d-sm-inline fw-semibold small">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2 rounded-3" aria-labelledby="profileDropdown">
                        <li>
                            <div class="px-3 py-2 text-secondary small">
                                <strong>Role:</strong> {{ Auth::user()->roles->first()?->name ?? 'N/A' }}
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item rounded-2 py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> My Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger rounded-2 py-2 w-100 text-start">
                                    <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main Content Slot -->
        <main class="main-content animate-fade-in">
            <!-- Alerts & Feedback Notifications -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm p-4 mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show rounded-4 border-0 shadow-sm p-4 mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-triangle-fill fs-4 text-warning"></i>
                        <div>{{ session('warning') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm p-4 mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-x-circle-fill fs-4 text-danger"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    <!-- Mobile Bottom Navigation Bar -->
    <div class="mobile-nav">
        <a href="{{ route('dashboard') }}" class="mobile-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('leaderboard') }}" class="mobile-nav-item {{ request()->routeIs('leaderboard') ? 'active' : '' }}">
            <i class="bi bi-trophy"></i>
            <span>Trophy</span>
        </a>
        <a href="{{ route('reports.index') }}" class="mobile-nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i>
            <span>Reports</span>
        </a>
    </div>

    <!-- jQuery and Bootstrap 5 JS Bundle -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables & Chart Libraries -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Layout Controls Script -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        function toggleDarkMode() {
            const isDark = document.body.classList.toggle('dark-mode');
            localStorage.setItem('dark-mode', isDark);
            updateDarkModeIcon(isDark);
        }

        function updateDarkModeIcon(isDark) {
            const icon = document.getElementById('darkModeIcon');
            if (isDark) {
                icon.className = 'bi bi-sun-fill text-warning';
            } else {
                icon.className = 'bi bi-moon-fill';
            }
        }

        // Initialize state of Dark Mode toggle icon on load
        updateDarkModeIcon(document.body.classList.contains('dark-mode'));

        // Initialize general DataTable lists
        $(document).ready(function() {
            $('.datatable').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "order": []
            });
        });

        // Real-time Clock Script
        function updateClock() {
            const now = new Date();
            const isMobile = window.innerWidth < 768;
            const options = isMobile 
                ? { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }
                : { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
                
            const clockEl = document.getElementById('realtimeClock');
            if (clockEl) {
                clockEl.textContent = now.toLocaleDateString('en-US', options);
            }
        }
        setInterval(updateClock, 1000);
        updateClock(); // Initial call
    </script>
    @stack('modals')
    @stack('scripts')
    
    <!-- PWA Service Worker -->
    {!! app(\EragLaravelPwa\Services\PWAService::class)->registerServiceWorkerScript() !!}
</body>
</html>
