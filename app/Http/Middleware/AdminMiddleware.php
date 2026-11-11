<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminId = $request->session()->get('admin_id');

        $admin = $adminId
            ? Admin::find($adminId)
            : null;

        if (!$admin) {
            $request->session()->forget('admin_id');

            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        app()->instance('currentAdmin', $admin);

        return $next($request);
    }
}
