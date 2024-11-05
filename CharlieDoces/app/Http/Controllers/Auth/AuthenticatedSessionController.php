<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => 'required',
        ], [
            'email.exists' => 'Login ou senha inválido. Por favor, tente novamente.',
        ]);

        var_dump($request);
        // if (Auth::attempt($request->only('email', 'password'))) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('dashboard');
        // }

        // throw ValidationException::withMessages([
        //     'email' => __('As credenciais fornecidas estão incorretas.'),
        // ]);
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required',
    //     ], [
    //         'email.exists' => 'O email fornecido não está registrado.',
    //     ]);

    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('dashboard');
    //     }

    //     throw ValidationException::withMessages([
    //         'email' => __('As credenciais fornecidas estão incorretas.'),
    //     ]);
    // }

    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(route('dashboard', absolute: false));
    // }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
