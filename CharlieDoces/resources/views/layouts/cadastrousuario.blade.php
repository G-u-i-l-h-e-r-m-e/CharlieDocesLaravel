<!DOCTYPE html>
<html>

<head>
    <title>Cadastro</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #FFFFFF;
            font-family: Arial, sans-serif;
        }

        .cadastro-container {
            display: flex;
            justify-content: center;
            text-align: start;
            width: 700px;
            height: 700px;
            font-family: 'Poppins', sans-serif;
        }

        .cadastro-container h2 {
            font-size: 32px;
            color: #4A2F25;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .cadastro-container h3 {
            font-size: 32px;
            color: #591F12;
            font-weight: bold;
            margin-bottom: 40px;
            margin-top: 40px;
        }

        .cadastro-container label {
            display: block;
            font-size: 20px;
            color: #8B4513;
            margin-bottom: 8px;
            text-align: left;
        }

        .cadastro-container input[type="date"],
        .cadastro-container input[type="email"],
        .cadastro-container input[type="password"],
        .cadastro-container input[type="text"] {
            width: 698px;
            height: 42px;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .cadastro-container button {
            width: 100%;
            padding: 12px;
            font-size: 24px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        .cadastro-container button:hover {
            background-color: #45A049;
        }
    </style>
</head>

<body>
    <div class="cadastro-container">
        <form>
            <h2>Criar Conta</h2>
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required />

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required />

            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" required />

            <h3>Endereço Completo</h3>
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" required />

            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" required />

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" required />

            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" />

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" required />

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required />

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" required />

            <button type="submit">Continuar</button>
        </form>
    </div>
</body>

</html>
