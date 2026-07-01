# Sales Performance Management System (SPMS)

A premium, enterprise-grade activity tracking and performance analytics platform custom-built for **SMEC Labs** using Laravel 13, PHP 8.4+, and MySQL.

This is an internal utility that automates sales activity logging, performance scoring, team structures, and real-time leaderboards. It is optimized for desktop, tablet, and mobile (collapsible sidebar, responsive cards, and mobile bottom navigation).

---

## 🛠️ Technology Stack
- **Framework**: Laravel 13
- **PHP**: 8.4+
- **Database**: MySQL / MariaDB (seeded and tested on port 3307)
- **Frontend Architecture**: TailwindCSS (Auth page) & Bootstrap 5.3 + Custom Glassmorphic Styles (Main Application Shell)
- **Charts**: Chart.js / ApexCharts
- **Data Exporting**: Laravel Excel (Maatwebsite Excel) & Barryvdh DomPDF
- **Authentication**: Laravel Breeze Authentication
- **Security & Authorization**: Spatie Laravel Permission

---

## 🔑 Demo Access Credentials
All accounts are seeded with default password: `password`

| Role | Email Address | Assigned Team / Scope |
|---|---|---|
| **Super Admin** | `admin@smeclabs.com` | Full Control |
| **Sales Head (HOD)** | `hod@smeclabs.com` | Cross-Team Performance Audits |
| **Team Leader (Alpha)** | `leader1@smeclabs.com` | Team Alpha Management |
| **Team Leader (Beta)** | `leader2@smeclabs.com` | Team Beta Management |
| **Vice Leader (Alpha)** | `vice1@smeclabs.com` | Team Alpha Backup Leader |
| **Sales Executive (Alpha 1)**| `exec1@smeclabs.com` | Individual scoring & timelines |
| **Sales Executive (Alpha 2)**| `exec2@smeclabs.com` | Individual scoring & timelines |
| **Sales Executive (Beta 1)** | `exec3@smeclabs.com` | Individual scoring & timelines |
| **Sales Executive (Beta 2)** | `exec4@smeclabs.com` | Individual scoring & timelines |

---

## 📈 Score Rules Configuration
Scores are recalculated automatically upon saving or modifying enquiry statuses:
- **Walk-in visit**: `1 Point`
- **Registration**: `1 Point`
- **Admission**: `4 Points`
- **Full Payment**: `6 Points`

*These values are fully configurable from the Super Admin / Sales Head settings dashboard.*

---

## 🚀 Installation & Local Launch

### Step 1: Clone or Open Workspace
Ensure you are inside the project workspace directory:
```bash
cd c:\Users\abhij\OneDrive\Desktop\spms
```

### Step 2: Validate Environment Configurations
The database connections are pre-configured to use **port 3307** with username `root` and password `""` (empty) pointing to the `spms` database.
Verify the `.env` settings:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=spms
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Run Database Migrations & Seeders
This will wipe any existing database, create standard tables, compile Spatie roles, and seed realistic student enquiries, timelines, follow-ups, and payments:
```bash
php artisan migrate:fresh --seed
```

### Step 4: Run Asset Builders
Bootstrap & Bootstrap Icons are pre-fetched from CDNs inside our master templates to guarantee immediate client-side rendering. For Tailwind Auth assets compilation, run:
```bash
npm install
npm run build
```

### Step 5: Start Local Development Server
Launch the artisan web server:
```bash
php artisan serve
```
Open [http://localhost:8000](http://localhost:8000) in your web browser and login using any of the credentials in the table above.
