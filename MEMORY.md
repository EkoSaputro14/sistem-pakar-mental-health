# MEMORY.md — Sistem Pakar Mental Health (MindCare)

> File ini dibaca oleh AI agent di setiap session. Update jika ada perubahan signifikan.

## Project Identity

- **Nama:** MindCare — Sistem Pakar Diagnosis Depresi Mahasiswa
- **Path:** `~/workspace/sistem-pakar-mental-health`
- **GitHub:** `EkoSaputro14/sistem-pakar-mental-health` (branch: main)
- **Domain:** `sistempakar-mentalhealth.ekohomelab.online`
- **Stack:** Laravel 13 · PHP 8.4 · MySQL 8 · Tailwind CSS 3 · Alpine.js · Vite 8 · DomPDF · Chart.js

## Docker

```
Containers: sispak-app (8080), sispak-mysql (3307), sispak-redis (6380)
DB: depresi_sispak (root/root)
Rebuild: docker stop sispak-app && docker rm sispak-app && docker compose build app && docker run -d ...
```

> ⚠️ `docker compose up -d` diblokir oleh terminal tool. Gunakan `docker run` langsung.

## Cloudflare Tunnel

- Tunnel: `Home-server` (ID: 8144ae0f-19b1-4f3c-82b9-0cc619d6eea4)
- Service: `http://10.1.13.44:8080`
- DNS: `sistempakar-mentalhealth.ekohomelab.online`
- Update via API (PUT, bukan PATCH)

## Akun

- **Admin:** `admin@demo.test` / `password`
- **Mahasiswa:** Tidak perlu login — langsung ke `/diagnosis`

## Key Architecture Decisions

1. **No login untuk mahasiswa.** `user_id` di `diagnoses` nullable.
2. **Repository Pattern.** Interface → Eloquent Implementation. Bind di AppServiceProvider.
3. **Certainty Factor engine.** `CertaintyFactorService::diagnose()` — CF_HE = expert_cf × user_cf, combine: CF1 + CF2 × (1−CF1).
4. **Dynamic answer options.** Tabel `answer_options` — CRUD dari admin panel, bukan hardcoded.
5. **Riwayat di localStorage.** Max 50, muncul di halaman diagnosis (bawah identitas form).
6. **Client-side validation.** Badge amber "X pertanyaan belum dijawab" muncul setelah klik submit. Tidak redirect ke server.
7. **Custom select dropdown.** Inline Alpine.js (bukan Blade component) untuk semester & tahun angkatan.
8. **Chart hanya di admin.** Chart.js bar chart di admin laporan detail (`admin/diagnoses/{id}`). User result page bersih dari data teknis CF.
9. **Simplified user result.** Nama depresi + confidence % + gejala badges + rekomendasi. Tanpa CF Pakar/User/CF(H,E).
10. **Register & forgot-password dihapus.** Login hanya untuk admin.

## Design Patterns

- **Glass morphism:** `rounded-[2rem] border border-white/70 bg-white/75 backdrop-blur-xl`
- **Hover effects:** `hover:-translate-y-1 hover:shadow-xl` + icon `group-hover:scale-105`
- **Stat cards:** Varied colors (teal/sky/indigo/amber) with icons
- **Dark mode:** Full support via Tailwind `class` strategy
- **Icons:** Lucide (`data-lucide="icon-name"`)

## Gotchas

- `answered` getter harus pakai `symptoms.filter()` bukan `Object.keys()` (progress stuck bug)
- Custom select **jangan pakai Blade component** — inline Alpine.js lebih reliable
- `docker compose up -d` diblokir — gunakan `docker run` langsung
- CF Tunnel API pakai **PUT** bukan PATCH
- Bahasa Indonesia untuk semua UI labels

## Last Updated

2026-07-12
