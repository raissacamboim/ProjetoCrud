<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Processar login
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if ($dados_usuario = $usuario->login($email, $senha)) {
            $_SESSION['usuario_id'] = $dados_usuario['id'];
            header('Location: gerenciador.php');
            exit();
        } else {
            $mensagem_erro = "Credenciais inválidas!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuario</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f5;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(135deg, #0062cc, #00c6ff);
            color: white;
            padding: 20px 0;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            border-bottom: 2px solid #0047b3;
            position: relative;
        }

        header h1 {
            font-size: 2.5rem;
            margin: 0;
        }

        header h3 {
            font-size: 1.5rem;
            margin-top: 10px;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 160px);
            padding: 20px;
        }

        form {

            margin: 30px auto;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 10px;

        }

        .box {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .box h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #0062cc;
        }

        .box label {
            font-size: 1rem;
            margin-bottom: 5px;
            display: block;
        }

        .box input[type="email"],
        .box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        .box input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #0062cc;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .box input[type="submit"]:hover {
            background-color: #009ec6;
        }

        .box p {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .box p a {
            color: #00c6ff;
            text-decoration: none;
        }

        .box p a:hover {
            text-decoration: underline;
        }

        .mensagem p {
            color: #f44336;
            text-align: center;
            margin-top: 10px;
            font-size: 1rem;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: white;
            margin-top: 50px;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>Portal de Notícias</h1>
        <h3>As últimas notícias em tempo real</h3>

    </header>

    <div class="container">
        <div class="box">
            <h1>AUTENTICAÇÃO</h1>
            <form method="POST">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <br><br>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <br><br>
                <input type="submit" name="login" value="Login">
            </form>
            <p>Não tem uma conta? <a href="./registrar.php">Registre-se aqui</a></p>
            <div class="mensagem">
                <?php if (isset($mensagem_erro)) echo '<p>' . $mensagem_erro . '</p>'; ?>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <p>&copy; 2024 Portal de Notícias | Todos os direitos reservados</p>
        </div>
    </footer>

</body>

</html>