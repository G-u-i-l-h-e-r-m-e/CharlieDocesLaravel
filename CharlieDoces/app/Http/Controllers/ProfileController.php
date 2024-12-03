<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\PedidoItem;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'USUARIO_NOME' => 'required|string|max:255',
            'USUARIO_EMAIL' => 'required|email|max:255|unique:USUARIO,USUARIO_EMAIL,' . $user->USUARIO_ID . ',USUARIO_ID',
            'USUARIO_CPF' => 'required|string|max:14',
        ]);
    
        $user->update($request->only(['USUARIO_NOME', 'USUARIO_EMAIL', 'USUARIO_CPF']));
    
        if ($user->endereco) {
            $user->endereco->update($request->only([
                'ENDERECO_LOGRADOURO', 'ENDERECO_NUMERO', 'ENDERECO_COMPLEMENTO', 
                'ENDERECO_CEP', 'ENDERECO_CIDADE', 'ENDERECO_ESTADO'
            ]));
        }
    
        return redirect()->route('profile.show')->with('success', 'Informações atualizadas com sucesso.');
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        return redirect('/')->with('success', 'Conta excluída com sucesso.');
    }

    public function show()
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login');
        }
    
        $endereco = $user->endereco; 
    
 
        $pedidoItems = PedidoItem::whereHas('pedido', function ($query) use ($user) {
            $query->where('USUARIO_ID', $user->USUARIO_ID);
        })->paginate(6); 
    
        return view('profile.show', compact('user', 'endereco', 'pedidoItems'));
    }
    

}