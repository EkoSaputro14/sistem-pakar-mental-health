# 🧠 MindCare — Sistem Pakar Diagnosis Depresi Mahasiswa

Sistem pakar berbasis web untuk skrining tingkat depresi mahasiswa menggunakan metode **Certainty Factor (CF)**. Mahasiswa dapat langsung melakukan diagnosis tanpa perlu mendaftar atau login.

![Laravel](https://img.shields.io/badge/Laravel-13-red)
![PHP](https://img.shields.io/badge/PHP-8.4-blue)
![MySQL](https://img.shields.io/badge/MySQL-8-orange)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-3-cyan)
![License](https://img.shields.io/badge/License-MIT-green)

---

## ✨ Fitur

### Untuk Mahasiswa (Tanpa Login)
- **Diagnosis Langsung** — Isi identitas (semester, prodi, tahun angkatan, tanggal lahir) lalu jawab pertanyaan gejala
- **Hasil Real-time** — Lihat tingkat depresi (Mild/Moderate/Severe) dengan persentase CF
- **Detail Breakdown** — Perbandingan CF per kategori depresi dengan Chart.js
- **Rekomendasi** — Saran penanganan berdasarkan hasil diagnosis
- **Export PDF** — Download hasil diagnosis dalam format PDF
- **Privat** — Tidak perlu login, data identitas tersimpan di hasil diagnosis

### Untuk Admin
- **Dashboard** — Statistik total mahasiswa, diagnosis, dan distribusi kategori
- **Kelola Gejala** — CRUD pertanyaan skrining dengan CF pakar
- **Kelola Depresi** — CRUD jenis/tingkat depresi (D1, D2, D3)
- **Kelola Rules** — Hubungkan gejala dengan depresi + nilai CF pakar
- **Kelola Rekomendasi** — CRUD saran penanganan per tingkat depresi
- **Opsi Jawaban** — Konfigurasi pilihan jawaban (label + nilai CF) dari admin panel
- **Laporan** — Lihat semua hasil diagnosis + filter + export PDF
- **Kelola Pengguna** — Lihat daftar admin

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 13, PHP 8.4 |
| **Frontend** | Tailwind CSS 3, Alpine.js, Blade |
| **Database** | MySQL 8 |
| **Build** | Vite 8 |
| **PDF** | DomPDF (barryvdh/laravel-dompdf) |
| **Icons** | Lucide |
| **Charts** | Chart.js 4 |
| **Deploy** | Docker (PHP 8.4 Apache) |

---

## 🚀 Instalasi

### Docker (Recommended)

```bash
# Clone repository
git clone https://github.com/EkoSaputro14/sistem-pakar-mental-health.git
cd sistem-pakar-mental-health

# Build & run
docker compose build app
docker compose up -d

# App berjalan di http://localhost:8080
```

### Manual (Laragon/XAMPP)

```bash
# Clone ke www directory
cd C:\laragon\www
git clone https://github.com/EkoSaputro14/sistem-pakar-mental-health.git
cd sistem-pakar-mental-health

# Install dependencies
composer install
npm install && npm run build

# Setup environment
cp .env.example .env
php artisan key:generate

# Edit .env sesuai konfigurasi database Anda
# DB_DATABASE=depresi_sispak

# Jalankan migrasi & seeder
php artisan migrate --seed

# Jalankan server
php artisan serve
```

---

## 👤 Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@demo.test` | `password` |

> Login hanya untuk admin. Mahasiswa langsung akses `/diagnosis` tanpa login.

---

## 📊 Arsitektur Diagnosis

```
┌─────────────────────────────────────────────────────────┐
│  Mahasiswa mengisi form identitas + jawaban gejala      │
└────────────────────────┬────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────┐
│  DiagnosisController::store()                           │
│  ┌───────────────────────────────────────────────────┐  │
│  │ CertaintyFactorService::diagnose()                │  │
│  │                                                   │  │
│  │  Per gejala:                                      │  │
│  │    CF_HE = expert_cf × user_cf                    │  │
│  │                                                   │  │
│  │  Combine (per depresi):                           │  │
│  │    CF_combined = CF1 + CF2 × (1 − CF1)           │  │
│  │                                                   │  │
│  │  Result: depresi dengan CF tertinggi              │  │
│  └───────────────────────────────────────────────────┘  │
└────────────────────────┬────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────┐
│  Simpan: diagnoses + diagnosis_details                  │
│  Tampilkan: /hasil/{id} (chart + breakdown + rekomendasi)│
│  Export: PDF via DomPDF                                 │
└─────────────────────────────────────────────────────────┘
```

---

## 📁 Struktur Database

```
answer_options    → Opsi jawaban (label, nilai CF, urutan)
symptoms          → Gejala pertanyaan (code, nama, pertanyaan, CF pakar)
depressions       → Jenis depresi (D1 Mild, D2 Moderate, D3 Severe)
rules             → Hubungan gejala ↔ depresi + expert_cf
recommendations   → Rekomendasi per tingkat depresi
diagnoses         → Hasil diagnosis (identitas + CF value + breakdown)
diagnosis_details → Detail per gejala (user_cf, expert_cf, cf_he)
users             → Admin users
```

---

## 🎨 Design System

- **Glass Morphism** — `rounded-[2rem]`, `backdrop-blur-xl`, `bg-white/75`
- **Primary Color** — Teal (`#0d9488`)
- **Dark Mode** — Full support via Tailwind `class` strategy
- **Typography** — Figtree font, hierarchy: `text-4xl font-extrabold` → `text-sm font-semibold`
- **Icons** — Lucide (consistent, modern)
- **Animations** — Page fade-in, progress bar, sliding nav indicator

---

## 📄 License

MIT License

---

**Dibuat untuk skripsi/tugas akhir** — Sistem Pakar Diagnosis Depresi Mahasiswa berbasis Web menggunakan Metode Certainty Factor.
