<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user || $user->email !== 'admin@example.com') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return $next($request);
    }
}
