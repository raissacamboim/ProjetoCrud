<?php
include_once './config/config.php';
include_once './classes/Usuario.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario($db);
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $fone = $_POST['fone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $usuario->registrar($nome, $sexo, $fone, $email, $senha);
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Usuário</title>
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
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(135deg, #0062cc, #00c6ff);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #0047b3;
            width: 100%;
            left: 0;
            top: 0;
            margin: 0;
        }

        header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
        }

        form {
            width: 100%;
            max-width: 440px;
            margin: 30px auto;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 1.2rem;
            margin-bottom: 10px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 16px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #0062cc;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #0047b3;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #009ec6;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: white;
            margin-top: 40px;
            width: 100%;
            left: 0;
            position: relative;
            box-sizing: border-box;
            bottom: 0;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            form {
                padding: 15px;
            }

            label {
                font-size: 1rem;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="submit"] {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Adicionar Usuário</h1>
        <h3>As últimas notícias em tempo real</h3>
    </header>

    <div class="container">
        <div class="box">
            <form method="POST">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required>
                <div class="sexo-labels">
                    <label for="masculino">
                        <input type="radio" id="masculino" name="sexo" value="M" required> Masculino
                    </label>
                    <label for="feminino">
                        <input type="radio" id="feminino" name="sexo" value="F" required> Feminino
                    </label>
                </div>
                <label for="fone">Fone:</label>
                <input type="text" name="fone" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" required>
                <input type="submit" value="Adicionar">
            </form>

            <footer>
                <div class="footer">
                    <p>&copy; 2024 Portal de Notícias | Todos os direitos reservados</p>
                </div>
            </footer>
</body>

</html>