<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaRole
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (!Auth::check()) {
            return redirect()->route('masuk');
        }

        if (!in_array(Auth::user()->role, $role)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
