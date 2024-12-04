<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a senha</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/header.css', 'resources/css/footer.css'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            background-color: #FFFFFF;
            font-family: Arial, sans-serif;
        }

        .forgotpassword-container {
            display: flex;
            justify-content: center;
            text-align: start;
            width: 700px;
            height: 700px;
            margin-top: 40px;
            font-family: 'Poppins', sans-serif;
        }

        .forgotpassword-container h2 {
            font-size: 32px;
            color: #4A2F25;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .forgotpassword-container label {
            display: block;
            font-size: 24px;
            color: #8B4513;
            margin-bottom: 8px;
            text-align: left;
        }

        .forgotpassword-container input[type="text"] {
            width: 698px;
            height: 52px;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .forgotpassword-container button {
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

        .forgotpassword-container button:hover {
            background-color: #45A049;
        }

        .forgotpassword-container p {
            font-weight: 500;
            font-size: 24px;
            line-height: 30px;
            margin-bottom: 5px;
            color: #591F12;
        }

        section {
            width: 100%;
        }
        .footer {
            width: 100%;
            height: 350px;
        }
    </style>
</head>

<body>
    <section>
        @include('profile.partials.header', ['categorias' => \App\Models\Categoria::all()])
    </section>
    <div class="forgotpassword-container">
        <form>
            <h2>Esqueceu a senha</h2>
            <label for="email-cpf">Obrigado por enviar seu endereço de e-mail.</label>
            <p>Enviamos a você um e-mail com as informações necessárias para redefinir sua senha.</p>
            <label for="email-cpf">O e-mail pode levar alguns minutos para chegar à sua conta. Verifique a caixa de spam
                para garantir que você o receba.</label>
        </form>
    </div>
    <section class="footer">
        @include('profile.partials.footer');
    </section>
</body>

</html>
