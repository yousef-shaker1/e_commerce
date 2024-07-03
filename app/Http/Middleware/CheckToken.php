<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = Auth::guard('sanctum')->user();

            if (!$user) {
                throw new \Exception('Authorization Token not found');
            }
        } catch (\Exception $e) {
            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json(['status' => 'Token is Invalid'], 401);
            } elseif ($e->getMessage() === 'Authorization Token not found') {
                return response()->json(['status' => 'Authorization Token not found'], 401);
            } else {
                return response()->json(['status' => 'An error occurred'], 500);
            }
        }
        return $next($request);
    }
}
