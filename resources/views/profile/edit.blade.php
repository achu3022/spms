<x-app-layout>
<style>
/* Custom Premium CSS */
.profile-wrapper {
    background: #f1f5f9;
    min-height: 100vh;
    padding-top: 40px;
    padding-bottom: 60px;
    font-family: 'Inter', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
}
.profile-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 40px;
}
.profile-sidebar {
    background: #ffffff;
    border-radius: 24px;
    padding: 40px 30px;
    box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
    height: fit-content;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.profile-main {
    display: flex;
    flex-direction: column;
    gap: 30px;
}
.profile-card {
    background: #ffffff;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.profile-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px -10px rgba(0,0,0,0.12);
}
.profile-card-danger {
    background: linear-gradient(to right, #ffffff, #fff5f5);
    border-left: 4px solid #ef4444;
}
.avatar-circle {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #9333ea);
    color: white;
    font-size: 48px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px auto;
    box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.5);
}
.profile-name {
    text-align: center;
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 8px 0;
    letter-spacing: -0.5px;
}
.profile-email {
    text-align: center;
    font-size: 15px;
    color: #64748b;
    margin: 0 0 24px 0;
}
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #ecfdf5;
    color: #059669;
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    box-shadow: inset 0 0 0 1px rgba(16, 185, 129, 0.2);
}
.status-badge .dot {
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    box-shadow: 0 0 8px rgba(16, 185, 129, 0.8);
}

/* Global Form Overrides for Beautiful Inputs & Buttons */
.profile-card header h2 {
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 4px 0;
}
.profile-card header p {
    font-size: 14px;
    color: #64748b;
    margin: 0 0 24px 0;
    line-height: 1.5;
}
.profile-card label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 8px;
}
.profile-card input[type="text"],
.profile-card input[type="email"],
.profile-card input[type="password"] {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    font-size: 15px;
    transition: all 0.2s ease;
    background: #f8fafc;
    box-sizing: border-box;
}
.profile-card input[type="text"]:focus,
.profile-card input[type="email"]:focus,
.profile-card input[type="password"]:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    background: #ffffff;
}
.profile-card button, 
.profile-card [type="submit"],
.btn-primary {
    background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
    color: white !important;
    padding: 12px 28px !important;
    border-radius: 12px !important;
    border: none !important;
    font-weight: 600 !important;
    font-size: 15px !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3) !important;
    letter-spacing: 0.5px;
}
.profile-card button:hover, 
.profile-card [type="submit"]:hover,
.btn-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4) !important;
}
.profile-card button:disabled, 
.profile-card [type="submit"]:disabled {
    opacity: 0.5 !important;
    cursor: not-allowed !important;
    transform: none !important;
}
.profile-card-danger button, 
.profile-card-danger [type="submit"] {
    background: linear-gradient(135deg, #ef4444, #b91c1c) !important;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3) !important;
}
.profile-card-danger button:hover, 
.profile-card-danger [type="submit"]:hover {
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4) !important;
}
.req-block {
    margin-top: 16px;
    padding: 20px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}
.req-title {
    font-size: 14px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 12px;
}
.req-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.req-list li {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
}
.req-list li svg {
    flex-shrink: 0;
}
.strength-bar-container {
    width: 100%;
    background: #e2e8f0;
    border-radius: 50px;
    height: 8px;
    overflow: hidden;
    margin-top: 4px;
}
.strength-bar {
    height: 100%;
    transition: all 0.3s ease;
    border-radius: 50px;
}
.match-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
}

@media (max-width: 900px) {
    .profile-container {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="profile-wrapper">
    <div class="profile-container">
        
        <!-- Sidebar -->
        <div class="profile-sidebar">
            @if(auth()->user()->employeeProfile && auth()->user()->employeeProfile->photo)
                <img src="{{ asset('storage/' . auth()->user()->employeeProfile->photo) }}" class="rounded-circle object-fit-cover shadow-sm" style="width: 120px; height: 120px; border: 4px solid #fff; box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.3) !important; margin: 0 auto 20px auto;">
            @else
                <div class="avatar-circle">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
            @endif
            <h3 class="profile-name">{{ auth()->user()->name }}</h3>
            <p class="profile-email">{{ auth()->user()->email }}</p>
            <div class="status-badge">
                <span class="dot"></span> Active Member
            </div>
        </div>

        <!-- Main Content -->
        <div class="profile-main">
            <div class="profile-card">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="profile-card">
                @include('profile.partials.update-password-form')
            </div>

            <div class="profile-card profile-card-danger">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>
</x-app-layout>
