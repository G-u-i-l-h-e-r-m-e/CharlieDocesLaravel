<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PedidoItem;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
     * Display the user's profile along with order history.
     */
    public function show(): View
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $endereco = $user->endereco;

        $pedidoItems = PedidoItem::join('PEDIDO', 'PEDIDO_ITEM.PEDIDO_ID', '=', 'PEDIDO.PEDIDO_ID') // Juntando a tabela PEDIDO
    ->where('PEDIDO.USUARIO_ID', $user->USUARIO_ID) 
    ->orderBy('PEDIDO.PEDIDO_DATA', 'desc') 
    ->select('PEDIDO_ITEM.*') 
    ->paginate(6); 

        return view('profile.show', compact('user', 'endereco', 'pedidoItems'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'USUARIO_NOME' => 'required|string|max:255',
            'USUARIO_EMAIL' => 'required|email|max:255|unique:usuario,USUARIO_EMAIL,' . $user->USUARIO_ID . ',USUARIO_ID',
            'USUARIO_CPF' => 'required|string|max:14',
            // Validações para endereço, se necessário
            'ENDERECO_LOGRADOURO' => 'required_if:endereco,1|string|max:255',
            'ENDERECO_NUMERO' => 'required_if:endereco,1|string|max:10',
            'ENDERECO_COMPLEMENTO' => 'nullable|string|max:255',
            'ENDERECO_CEP' => 'required_if:endereco,1|string|max:10',
            'ENDERECO_CIDADE' => 'required_if:endereco,1|string|max:100',
            'ENDERECO_ESTADO' => 'required_if:endereco,1|string|max:100',
        ]);

        $user->update($request->only(['USUARIO_NOME', 'USUARIO_EMAIL', 'USUARIO_CPF']));

        // Atualizar ou criar endereço
        $enderecoData = $request->only([
            'ENDERECO_LOGRADOURO', 'ENDERECO_NUMERO', 'ENDERECO_COMPLEMENTO', 
            'ENDERECO_CEP', 'ENDERECO_CIDADE', 'ENDERECO_ESTADO'
        ]);

        if ($user->endereco) {
            $user->endereco->update($enderecoData);
        } else {
            $user->endereco()->create($enderecoData);
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
}