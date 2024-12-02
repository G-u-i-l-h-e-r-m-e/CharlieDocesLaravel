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
        $input = $request->input('email');
        
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('USUARIO_EMAIL', $input)->first();
        } else {
            $user = User::where('USUARIO_CPF', $input)->first();
        }

        if ($user) {
            return redirect()->route('login')->withInput(['email' => $input]);
        } else {
            return redirect()->route('cadastro');
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
