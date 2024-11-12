<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Lista de Usuários</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>CPF</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->USUARIO_ID }}</td>
                    <td>{{ $user->USUARIO_NOME }}</td>
                    <td>{{ $user->USUARIO_EMAIL }}</td>
                    <td>{{ $user->USUARIO_SENHA }}</td>
                    <td>{{ $user->USUARIO_CPF }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>