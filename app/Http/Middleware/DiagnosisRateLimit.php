<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiagnosisRateLimit
{
    public function handle(Request $request, Closure $next): Response
    {
        $sessionKey = 'last_diagnosis_at';

        if ($request->session()->has($sessionKey)) {
            $lastAt = $request->session()->get($sessionKey);
            $elapsed = now()->diffInSeconds($lastAt);

            if ($elapsed < 30) {
                $remaining = 30 - $elapsed;

                return back()->withErrors([
                    'answers' => "Tunggu {$remaining} detik sebelum mengirim diagnosis lagi.",
                ])->withInput();
            }
        }

        $response = $next($request);

        // Simpan waktu submit setelah berhasil
        $request->session()->put($sessionKey, now());

        return $response;
    }
}
