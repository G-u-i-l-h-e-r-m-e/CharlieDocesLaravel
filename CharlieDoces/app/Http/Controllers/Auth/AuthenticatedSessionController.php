<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login-email');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function emailAuthenticate(Request $request): RedirectResponse
    {
        $email = $request->input('email');

        $user = User::where('USUARIO_EMAIL', $email)->first();

        if ($user) {
            return redirect()->route('login')->withInput(['email' => $email]);
        } else {
            return redirect('cadastro');
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redireciona para /home após o logout
        return redirect('/home');
    }
}