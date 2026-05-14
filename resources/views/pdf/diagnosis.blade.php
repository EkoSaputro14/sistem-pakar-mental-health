<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Diagnosis</title>
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        body { font-size: 12px; color: #111827; }
        h1 { font-size: 18px; margin: 0 0 6px; }
        h2 { font-size: 14px; margin: 18px 0 8px; }
        .muted { color: #6B7280; }
        .box { border: 1px solid #E5E7EB; border-radius: 8px; padding: 12px; }
        .grid { width: 100%; }
        .grid td { vertical-align: top; padding: 6px 8px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border-bottom: 1px solid #E5E7EB; padding: 8px 6px; text-align: left; }
        .table th { background: #F9FAFB; font-weight: 700; }
        .right { text-align: right; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 999px; background: #EFF6FF; color: #1D4ED8; font-weight: 700; font-size: 11px; }
        .note { border: 1px solid #FDE68A; background: #FFFBEB; border-radius: 8px; padding: 10px; color: #92400E; }
    </style>
</head>
<body>
    <h1>{{ config('app.name') }}</h1>
    <div class="muted">Dokumen hasil diagnosis (metode Certainty Factor)</div>

    <div style="height: 12px"></div>

    <div class="box">
        <table class="grid">
            <tr>
                <td style="width: 33%">
                    <div class="muted">Pengguna</div>
                    <div style="font-weight: 700; margin-top: 2px">{{ $diagnosis->user?->name }}</div>
                    <div class="muted" style="margin-top: 2px">{{ $diagnosis->user?->email }}</div>
                </td>
                <td style="width: 33%">
                    <div class="muted">Tanggal</div>
                    <div style="font-weight: 700; margin-top: 2px">{{ $diagnosis->created_at->format('d M Y H:i') }}</div>
                </td>
                <td style="width: 34%">
                    <div class="muted">Hasil</div>
                    <div style="font-weight: 700; margin-top: 2px">{{ $diagnosis->depression?->name ?? '-' }}</div>
                    <div style="margin-top: 4px">
                        <span class="badge">{{ $diagnosis->depression?->code ?? '-' }}</span>
                    </div>
                </td>
            </tr>
        </table>

        <div style="height: 10px"></div>

        <table class="grid">
            <tr>
                <td>
                    <div class="muted">Tingkat Keyakinan</div>
                    <div style="font-size: 16px; font-weight: 700; margin-top: 2px">{{ number_format((float) $confidencePercent, 2) }}%</div>
                    <div class="muted" style="margin-top: 4px">CF: {{ $diagnosis->cf_value }}</div>
                </td>
            </tr>
        </table>
    </div>

    <h2>Perbandingan Nilai CF per Kategori</h2>
    <table class="table">
        <thead>
            <tr>
                <th style="width: 20%">Kategori</th>
                <th style="width: 40%">Nilai CF</th>
                <th style="width: 40%">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach (($diagnosis->cf_breakdown ?? []) as $code => $cf)
                <tr>
                    <td style="font-weight: 700">{{ $code }}</td>
                    <td>{{ number_format((float) $cf, 4) }}</td>
                    <td>{{ number_format(((float) $cf) * 100, 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Detail Jawaban Gejala</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Gejala</th>
                <th>Jawaban</th>
                <th class="right">CF Pakar</th>
                <th class="right">CF User</th>
                <th class="right">CF(H,E)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diagnosis->details as $detail)
                <tr>
                    <td>
                        <div style="font-weight: 700">{{ $detail->symptom->code ?? '-' }}</div>
                        <div class="muted" style="margin-top: 2px">{{ $detail->symptom->name ?? '-' }}</div>
                    </td>
                    <td>{{ $detail->user_answer }}</td>
                    <td class="right">{{ number_format((float) $detail->expert_cf, 2) }}</td>
                    <td class="right">{{ number_format((float) $detail->user_cf, 2) }}</td>
                    <td class="right">{{ number_format((float) $detail->cf_he, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Rekomendasi Penanganan</h2>
    @if (($recommendations ?? collect())->count())
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 30%">Judul</th>
                    <th style="width: 70%">Isi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recommendations as $rec)
                    <tr>
                        <td style="font-weight: 700">{{ $rec->title }}</td>
                        <td>{{ $rec->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="muted">Belum ada rekomendasi untuk kategori ini.</div>
    @endif

    <div style="height: 14px"></div>

    <div class="note">
        Catatan: Hasil ini adalah skrining awal berbasis sistem pakar dan tidak menggantikan konsultasi profesional.
    </div>
</body>
</html>
