<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
            // Attempt to authenticate the user
            $request->authenticate();

            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();
    
            // Retrieve the authenticated user
            $user = Auth::user();
            
            // Redirect based on is_admin attribute
            if ($user->roles_name !== ["user"]) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        
        // Regenerate the session token
        $request->session()->regenerateToken();
        
            return redirect('/');
    }
}
