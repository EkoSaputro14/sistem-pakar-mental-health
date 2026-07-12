# AGENTS.md — Sistem Pakar Depresi Mahasiswa (MindCare)

## Project Overview

Sistem pakar diagnosis tingkat depresi mahasiswa menggunakan metode **Certainty Factor (CF)**. Mahasiswa mengisi skrining tanpa login → sistem menghitung CF → menampilkan hasil diagnosis + rekomendasi. Admin mengelola data master (gejala, depresi, rules, rekomendasi, opsi jawaban) dan melihat laporan.

**Stack:** Laravel 13 · PHP 8.4 · MySQL 8 · Tailwind CSS 3 · Alpine.js · Vite 8 · DomPDF
**Deploy:** Docker (Apache) · Cloudflare Tunnel · `sistempakar-mentalhealth.ekohomelab.online`

---

## Architecture

### Request Flow

```
Browser → Apache (Docker) → Laravel Router → Middleware → Controller → Repository → Eloquent → MySQL
                                                                     ↓
                                                              Blade View (Tailwind + Alpine.js)
                                                                     ↓
                                                              DomPDF (export PDF)
```

### Key Design Decisions

- **No user login for diagnosis.** Mahasiswa langsung isi identitas (tgl lahir, semester, prodi, tahun angkatan) + jawaban gejala → submit. `user_id` di tabel `diagnoses` nullable.
- **Repository Pattern.** Semua query database via Repository Interface → Eloquent Implementation. Controller tidak langsung query model.
- **Certainty Factor engine.** `CertaintyFactorService::diagnose()` menghitung CF per depresi: `CF_HE = expert_cf × user_cf`, combine: `CF1 + CF2 × (1 − CF1)`. Ambil depresi CF tertinggi.
- **Dynamic answer options.** Opsi jawaban (label + nilai CF) disimpan di tabel `answer_options`, bisa di-CRUD dari admin panel. Tidak ada hardcoded values.
- **Admin-only roles.** Semua user di tabel `users` adalah admin. Tidak ada role selector. Login hanya untuk admin.
- **Session-based auth.** Laravel Breeze + session driver database.

---

## Directory Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/              # Admin CRUD controllers
│   │   │   ├── AnswerOptionController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── DepressionController.php
│   │   │   ├── DiagnosisReportController.php
│   │   │   ├── RecommendationController.php
│   │   │   ├── RuleController.php
│   │   │   ├── SymptomController.php
│   │   │   └── UserController.php
│   │   ├── Auth/               # Breeze auth (login-only, register disabled)
│   │   ├── User/
│   │   │   ├── DiagnosisController.php      # Form identitas + skrining
│   │   │   ├── DiagnosisResultController.php # Hasil + PDF
│   │   │   └── HomeController.php           # Landing, tentang, kontak darurat
│   │   └── ProfileController.php
│   ├── Middleware/
│   └── Requests/
│       └── User/
│           └── SubmitDiagnosisRequest.php    # Validasi identitas + answers
├── Models/
│   ├── AnswerOption.php        # Opsi jawaban (label, value, sort_order, is_active)
│   ├── Depression.php          # Jenis depresi (code D1/D2/D3, name, description)
│   ├── Diagnosis.php           # Hasil diagnosis (cf_value, cf_breakdown, identitas)
│   ├── DiagnosisDetail.php     # Detail per gejala (user_cf, expert_cf, cf_he)
│   ├── Recommendation.php      # Rekomendasi per depresi
│   ├── Rule.php                # Hubungan gejala↔depresi + expert_cf
│   ├── Symptom.php             # Gejala pertanyaan (code, name, question, base_cf)
│   └── User.php                # Admin user (isAdmin(), role)
├── Repositories/
│   ├── Contracts/              # Interfaces
│   │   ├── DiagnosisRepositoryInterface.php
│   │   ├── SymptomRepositoryInterface.php
│   │   └── UserRepositoryInterface.php
│   └── Eloquent/               # Implementations
│       ├── DiagnosisRepository.php
│       ├── SymptomRepository.php
│       └── UserRepository.php
└── Services/
    └── CertaintyFactorService.php  # CF calculation engine

database/
├── migrations/                 # 13 migrations
├── seeders/
│   ├── DatabaseSeeder.php      # Calls all seeders + creates admin/demo user
│   ├── SymptomSeeder.php
│   ├── DepressionSeeder.php
│   ├── RuleSeeder.php
│   ├── RecommendationSeeder.php
│   └── AnswerOptionSeeder.php  # Default 4 opsi: Tidak Pernah(0.0) → Selalu(1.0)

resources/views/
├── admin/                      # Admin panel views
│   ├── answer-options/         # CRUD opsi jawaban
│   ├── dashboard.blade.php     # Stats: total mahasiswa, diagnosis, kategori
│   ├── depressions/            # CRUD jenis depresi
│   ├── diagnoses/              # Laporan diagnosis (index, show)
│   ├── recommendations/        # CRUD rekomendasi
│   ├── rules/                  # CRUD rules
│   ├── symptoms/               # CRUD gejala
│   └── users/                  # Data pengguna (read-only, no role edit)
├── auth/
│   └── login.blade.php         # Login page (register & forgot-password disabled)
├── components/                 # Blade components (nav-link, modal, flash, etc)
├── layouts/
│   ├── app.blade.php           # Authenticated layout (sidebar + nav)
│   ├── guest.blade.php         # Guest layout (split card with dark sidebar)
│   └── navigation.blade.php    # Sticky nav with sliding underline indicator
├── pdf/
│   └── diagnosis.blade.php     # PDF template for DomPDF
└── user/
    ├── home.blade.php          # Landing page hero + educational section
    ├── diagnosis.blade.php     # 2-step form: identitas → pertanyaan (Alpine.js)
    ├── result.blade.php        # Hasil: CF chart + breakdown + rekomendasi
    ├── about.blade.php         # Tentang depresi
    └── emergency.blade.php     # Kontak darurat
```

---

## Routes

### Public (no auth)
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | user.home | Landing page |
| GET | `/login` | login | Login form |
| POST | `/login` | — | Process login |
| GET | `/tentang-depresi` | user.about | Tentang depresi |
| GET | `/kontak-darurat` | user.emergency | Kontak darurat |
| GET | `/diagnosis` | user.diagnosis | Form skrining |
| POST | `/diagnosis` | user.diagnosis.submit | Submit diagnosis |
| GET | `/hasil/{diagnosis}` | user.result | Hasil diagnosis |
| GET | `/hasil/{diagnosis}/pdf` | user.result.pdf | Download PDF |

### Authenticated (admin only)
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/admin/dashboard` | admin.dashboard | Dashboard admin |
| Resource | `/admin/symptoms` | admin.symptoms.* | CRUD gejala |
| Resource | `/admin/depressions` | admin.depressions.* | CRUD depresi |
| Resource | `/admin/rules` | admin.rules.* | CRUD rules |
| Resource | `/admin/recommendations` | admin.recommendations.* | CRUD rekomendasi |
| Resource | `/admin/answer-options` | admin.answer-options.* | CRUD opsi jawaban |
| GET | `/admin/diagnoses` | admin.diagnoses.index | Laporan diagnosis |
| GET | `/admin/diagnoses/{diagnosis}` | admin.diagnoses.show | Detail laporan |
| GET | `/admin/diagnoses/{diagnosis}/pdf` | admin.diagnoses.pdf | Export PDF |
| GET | `/admin/users` | admin.users.index | Data pengguna |
| GET | `/admin/users/{user}/edit` | admin.users.edit | Detail pengguna |
| POST | `/logout` | logout | Logout |

---

## Database Schema

### Core Tables

**answer_options** — Opsi jawaban skrining (dynamic, admin-manageable)
- `id`, `label`, `value` (DECIMAL 3,1), `sort_order`, `is_active`, `timestamps`

**symptoms** — Gejala pertanyaan
- `id`, `code`, `name`, `question`, `base_cf` (DECIMAL), `is_active`, `timestamps`

**depressions** — Jenis/tingkat depresi
- `id`, `code` (D1/D2/D3), `name`, `description`, `is_active`, `timestamps`

**rules** — Hubungan gejala ↔ depresi
- `id`, `depression_id` (FK), `symptom_id` (FK), `expert_cf` (DECIMAL), `timestamps`

**recommendations** — Rekomendasi per depresi
- `id`, `depression_id` (FK), `title`, `content`, `is_active`, `timestamps`

**diagnoses** — Hasil diagnosis mahasiswa
- `id`, `user_id` (FK, nullable), `depression_id` (FK, nullable), `cf_value` (DECIMAL 6,4), `cf_breakdown` (JSON), `tanggal_lahir` (DATE), `semester`, `tahun_angkatan`, `prodi`, `timestamps`

**diagnosis_details** — Detail per gejala
- `id`, `diagnosis_id` (FK), `symptom_id` (FK), `user_answer`, `user_cf`, `expert_cf`, `cf_he`, `timestamps`

**users** — Admin users
- `id`, `name`, `email`, `password`, `role` (admin), `email_verified_at`, `remember_token`, `timestamps`

---

## Key Patterns & Conventions

### Controller Pattern
```php
class SomeController extends Controller
{
    public function __construct(private readonly SomeRepositoryInterface $repo) {}

    public function index()
    {
        $items = $this->repo->paginate(request('search'));
        return view('admin.some.index', compact('items'));
    }
}
```

### Repository Pattern
- Interface in `app/Repositories/Contracts/`
- Implementation in `app/Repositories/Eloquent/`
- Bind in `AppServiceProvider` using `->needs()`
- Controllers type-hint interfaces, never concrete classes

### View Pattern
- All views use `<x-app-layout>` (authenticated) or `<x-guest-layout>` (guest)
- Glass morphism cards: `rounded-[2rem] border border-white/70 bg-white/75 backdrop-blur-xl shadow-xl`
- Dark mode: `dark:border-white/10 dark:bg-white/5 dark:text-slate-300`
- Teal primary: `text-teal-700 bg-teal-600 hover:bg-teal-700`
- Icons: Lucide (`data-lucide="icon-name"`)

### Validation Pattern
- Form Requests in `app/Http/Requests/`
- Use `$request->validated()`, never `$request->all()`
- Custom messages in Indonesian

### Diagnosis Flow
1. User visits `/diagnosis`
2. Step 1: Fill identitas (tanggal_lahir, semester, tahun_angkatan, prodi)
3. Step 2: Answer symptom questions (dynamic from DB, answer options from `answer_options` table)
4. Submit → `DiagnosisController::store()` → `CertaintyFactorService::diagnose()`
5. Create `Diagnosis` + `DiagnosisDetail` records
6. Redirect to `/hasil/{id}` with CF breakdown + recommendations

### Admin Dashboard
- Total Mahasiswa = count of `diagnoses` table (not users)
- Total Diagnosis = count of `diagnoses` table
- Kategori Depresi = count of `depressions` table
- Chart.js bar chart for diagnosis distribution

---

## Docker Setup

### Build & Run
```bash
docker compose build app
docker compose up -d
```

### Containers
| Container | Image | Port | Description |
|-----------|-------|------|-------------|
| sispak-app | php:8.4-apache | 8080→80 | Laravel app |
| sispak-mysql | mysql:8 | 3307→3306 | Database |
| sispak-redis | redis:7-alpine | 6380→6379 | Cache |

### Environment
```env
APP_NAME="Sistem Pakar Depresi Mahasiswa"
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=depresi_sispak
DB_USERNAME=root
DB_PASSWORD=root
```

### Entrypoint (`docker-entrypoint.sh`)
1. Generate APP_KEY if not set
2. Wait for MySQL (`migrate:status`)
3. Run migrations + seeders
4. Cache config/routes/views
5. Start Apache

---

## Credential Files

- `.env` — Database credentials, app key (gitignored)
- `docker-entrypoint.sh` — Container startup script

## Gotchas

- `user_id` in `diagnoses` is nullable — mahasiswa tidak perlu login
- Register & forgot-password routes dihapus — hanya login untuk admin
- Answer options di-seed dengan `updateOrCreate` berdasarkan `value` — aman re-run
- `cf_breakdown` stored as JSON — contoh: `{"D1": 0.85, "D2": 0.42, "D3": 0.15}`
- PDF export via DomPDF — template di `resources/views/pdf/diagnosis.blade.php`
- Alpine.js `x-data` di diagnosis form mengelola 2 step: `step: 'identitas'` → `step: 'questions'`
- Dark mode via Tailwind `class` strategy — toggle via localStorage + `document.documentElement.classList.toggle('dark')`
