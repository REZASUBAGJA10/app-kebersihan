<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// Import ini penting untuk pengecekan tipe file
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PreventBackHistory
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Jika response adalah download file (Excel/PDF), lewatkan saja tanpa menambah header
        if ($response instanceof BinaryFileResponse) {
            return $response;
        }

        // Untuk halaman biasa, tetap pasang pengaman agar tidak bisa di-back saat logout
        return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
    }
}