<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Exibe a página de confirmação de envio, se necessário
    public function sent()
    {
        return view('sent.index');
    }

    // Realiza o logout e redireciona para a página inicial
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireciona para a página inicial após o logout
        return redirect('/home');
    }
}
