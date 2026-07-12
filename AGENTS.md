# AGENTS.md — Sistem Pakar Depresi Mahasiswa (MindCare)

## Project Overview

Sistem pakar diagnosis tingkat depresi mahasiswa menggunakan metode **Certainty Factor (CF)**. Mahasiswa mengisi skrining tanpa login → sistem menghitung CF → menampilkan hasil diagnosis + rekomendasi. Admin mengelola data master (gejala, depresi, rules, rekomendasi, opsi jawaban) dan melihat laporan dengan chart.

**Stack:** Laravel 13 · PHP 8.4 · MySQL 8 · Tailwind CSS 3 · Alpine.js · Vite 8 · DomPDF · Chart.js
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
- **Riwayat di localStorage.** Hasil diagnosis disimpan di browser user (localStorage, max 50). Muncul di halaman diagnosis (bawah identitas). Tidak perlu login.
- **Client-side validation.** Validasi pertanyaan belum dijawab dilakukan di browser (Alpine.js). Badge amber "X pertanyaan belum dijawab" muncul setelah klik submit. Tidak ada redirect ke server.
- **Custom select dropdown.** Menggunakan Alpine.js inline (bukan native `<select>`) untuk semester dan tahun angkatan.
- **Chart hanya di admin.** Chart.js bar chart untuk CF breakdown hanya di halaman admin laporan detail. User result page dibersihkan dari data teknis CF.

---

## Directory Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
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
│   │   └── EnsureRole.php
│   └── Requests/
│       └── User/
│           └── SubmitDiagnosisRequest.php    # Validasi identitas + answers
├── Models/
│   ├── AnswerOption.php        # Opsi jawaban (label, value, sort_order, is_active)
│   ├── Depression.php          # Jenis depresi (code D1/D2/D3, name, description)
│   ├── Diagnosis.php           # Hasil diagnosis (cf_value, cf_breakdown, identitas, umur)
│   ├── DiagnosisDetail.php     # Detail per gejala (user_cf, expert_cf, cf_he)
│   ├── Recommendation.php      # Rekomendasi per depresi
│   ├── Rule.php                # Hubungan gejala↔depresi + expert_cf
│   ├── Symptom.php             # Gejala pertanyaan (code, name, question, base_cf)
│   └── User.php                # Admin user (isAdmin(), role)
├── Repositories/
│   ├── Contracts/              # Interfaces
│   └── Eloquent/               # Implementations
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
├── admin/
│   ├── answer-options/         # CRUD opsi jawaban
│   ├── dashboard.blade.php     # Stats: total mahasiswa(diagnosis), diagnosis, kategori
│   ├── depressions/            # CRUD jenis depresi
│   ├── diagnoses/
│   │   ├── index.blade.php     # Laporan list (search by prodi/angkatan)
│   │   └── show.blade.php      # Detail + CF table + Chart.js bar chart
│   ├── recommendations/        # CRUD rekomendasi
│   ├── rules/                  # CRUD rules (custom select dropdown)
│   ├── symptoms/               # CRUD gejala
│   └── users/                  # Data pengguna (read-only, no role edit)
├── auth/
│   └── login.blade.php         # Login page (admin-focused, register disabled)
├── components/
│   ├── custom-select.blade.php # Custom Alpine.js dropdown (unused in favor of inline)
│   ├── custom-select-option.blade.php
│   └── ... (standard Breeze components)
├── layouts/
│   ├── app.blade.php           # Authenticated layout
│   ├── guest.blade.php         # Guest layout (admin-focused sidebar)
│   └── navigation.blade.php    # Sticky nav (Beranda, Tentang, Diagnosis, Kontak Darurat)
├── pdf/
│   └── diagnosis.blade.php     # PDF template (identitas + CF table + rekomendasi)
└── user/
    ├── home.blade.php          # Landing page (hero + stat cards + educational)
    ├── diagnosis.blade.php     # 2-step form: identitas → pertanyaan + riwayat
    ├── result.blade.php        # Simplified: nama depresi + confidence + gejala badges + rekomendasi
    ├── about.blade.php         # Tentang depresi
    └── emergency.blade.php     # Kontak darurat
```

---

## Routes

### Public (no auth)
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | user.home | Landing page |
| GET | `/login` | login | Login form (admin only) |
| POST | `/login` | — | Process login |
| GET | `/tentang-depresi` | user.about | Tentang depresi |
| GET | `/kontak-darurat` | user.emergency | Kontak darurat |
| GET | `/diagnosis` | user.diagnosis | Form skrining + riwayat |
| POST | `/diagnosis` | user.diagnosis.submit | Submit diagnosis |
| GET | `/hasil/{diagnosis}` | user.result | Hasil diagnosis (simplified) |
| GET | `/hasil/{diagnosis}/pdf` | user.result.pdf | Download PDF |

### Authenticated (admin only)
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/admin/dashboard` | admin.dashboard | Dashboard admin |
| Resource | `/admin/symptoms` | admin.symptoms.* | CRUD gejala |
| Resource | `/admin/depressions` | admin.depressions.* | CRUD depresi |
| Resource | `/admin/rules` | admin.rules.* | CRUD rules (custom select) |
| Resource | `/admin/recommendations` | admin.recommendations.* | CRUD rekomendasi (custom select) |
| Resource | `/admin/answer-options` | admin.answer-options.* | CRUD opsi jawaban |
| GET | `/admin/diagnoses` | admin.diagnoses.index | Laporan diagnosis |
| GET | `/admin/diagnoses/{diagnosis}` | admin.diagnoses.show | Detail + chart |
| GET | `/admin/diagnoses/{diagnosis}/pdf` | admin.diagnoses.pdf | Export PDF |
| GET | `/admin/users` | admin.users.index | Data pengguna |
| GET | `/admin/users/{user}/edit` | admin.users.edit | Detail pengguna |
| POST | `/logout` | logout | Logout |

---

## Database Schema

**answer_options** — Opsi jawaban skrining (dynamic, admin-manageable)
- `id`, `label`, `value` (DECIMAL 3,1), `sort_order`, `is_active`, `timestamps`

**symptoms** — Gejala pertanyaan
- `id`, `code`, `name`, `question`, `base_cf`, `is_active`, `timestamps`

**depressions** — Jenis/tingkat depresi
- `id`, `code` (D1/D2/D3), `name`, `description`, `is_active`, `timestamps`

**rules** — Hubungan gejala ↔ depresi
- `id`, `depression_id` (FK), `symptom_id` (FK), `expert_cf`, `timestamps`

**recommendations** — Rekomendasi per depresi
- `id`, `depression_id` (FK), `title`, `content`, `is_active`, `timestamps`

**diagnoses** — Hasil diagnosis mahasiswa
- `id`, `user_id` (FK, nullable), `depression_id` (FK), `cf_value`, `cf_breakdown` (JSON), `tanggal_lahir`, `semester`, `tahun_angkatan`, `prodi`, `timestamps`

**diagnosis_details** — Detail per gejala
- `id`, `diagnosis_id` (FK), `symptom_id` (FK), `user_answer`, `user_cf`, `expert_cf`, `cf_he`, `timestamps`

**users** — Admin users
- `id`, `name`, `email`, `password`, `role`, `timestamps`

---

## Key Patterns & Conventions

### Controller Pattern
```php
class SomeController extends Controller
{
    public function __construct(private readonly SomeRepositoryInterface $repo) {}
}
```

### View Pattern
- Glass morphism: `rounded-[2rem] border border-white/70 bg-white/75 backdrop-blur-xl`
- Teal primary: `text-teal-700 bg-teal-600`
- Icons: Lucide (`data-lucide="icon-name"`)
- Custom selects: Inline Alpine.js with `x-data`, `x-show`, `x-on:click`
- Stat cards: `hover:-translate-y-1 hover:shadow-xl` + icon with `group-hover:scale-105`

### Diagnosis Flow
1. User `/diagnosis` → Step 1: identitas (custom dropdown semester/tahun) → Step 2: pertanyaan
2. Client-side validation: badge amber jika ada yang belum dijawab
3. Submit → `CertaintyFactorService::diagnose()` → simpan ke DB
4. Redirect `/hasil/{id}` → simplified result page (nama depresi, confidence, gejala badges, rekomendasi)
5. ID tersimpan di localStorage → muncul di riwayat (bawah identitas form)

### Admin Dashboard
- Total Mahasiswa = count `diagnoses` (bukan users)
- Total Diagnosis = count `diagnoses`
- Chart.js di admin laporan detail (CF breakdown bar chart)

---

## Docker

```bash
docker compose build app
docker compose up -d
# App: http://localhost:8080
# MySQL: localhost:3307, Redis: localhost:6380
```

### Containers
| Container | Port | Description |
|-----------|------|-------------|
| sispak-app | 8080→80 | Laravel + Apache |
| sispak-mysql | 3307→3306 | MySQL 8 |
| sispak-redis | 6380→6379 | Redis 7 |

### Entrypoint
1. Generate APP_KEY → 2. Wait MySQL → 3. Migrate + seed → 4. Cache config/routes/views → 5. Start Apache

---

## Gotchas

- `user_id` di `diagnoses` nullable — mahasiswa tidak perlu login
- Register & forgot-password routes dihapus
- Answer options di-seed dengan `updateOrCreate` berdasarkan `value`
- Riwayat di localStorage (browser user), bukan di server
- Chart.js hanya di admin, tidak di user result page
- Custom select pakai inline Alpine.js (bukan Blade component)
- `answered` getter pakai `symptoms.filter()` bukan `Object.keys()`
