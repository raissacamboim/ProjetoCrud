<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);
$usuarios = $usuario->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Notícias</title>

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
            margin-top: 160px;
        }

        .box {
            width: 100%;
            max-width: 450px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
           
        }

        .form-title {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #0062cc;
        }

        form label {
            font-size: 1rem;
            margin-bottom: 5px;
            display: block;
        }

        form input[type="text"],
        form input[type="date"],
        form input[type="file"],
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        form textarea {
            resize: vertical;
        }

        form button {
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

        form button:hover {
            background-color: #009ec6;
        }

        .box p {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 10px;
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
            width: 100%;
            margin-top: 160px;
        }

        .buttons {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        .buttons button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .buttons button a {
            text-decoration: none;
            color: white;
        }

        .buttons button:hover {
            background-color: #45a049;
        }

        header .buttons {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    header .buttons button {
        background-color: #00c6ff;
        border: none;
        color: white;
        padding: 12px 25px;
        font-size: 1.1rem;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        transition: background 0.3s ease;
    }

    header .buttons button a {
        text-decoration: none;
        color: white;
    }

    header .buttons button:hover {
        background-color: #009ec6;
    }

        @media (max-width: 768px) {
            header h1 {
                font-size: 2.2rem;
            }

            header h3 {
                font-size: 1.3rem;
            }

            .container {
                height: auto;
                padding: 10px;
            }

            form {
                padding: 15px;
                margin-top: 20px;
            }
        }
    </style>

</head>

<body>
    <header>
        <h1>Notícias 24h</h1>
        <h3>As últimas notícias em tempo real</h3>
        <div class="buttons">
            <button type="submit"><a href="./gerenciador.php">Voltar</a></button>
        </div>
    </header>

    <div class="container">
        <div class="box">
            <form method="POST" action="./salvarnoticias.php" enctype="multipart/form-data">
                <div class="form-title">
                    <h3>Cadastro de Notícias</h3>
                </div>

                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" required>

                <label for="autor">Autor</label>
                <select name="autor" id="autor" required>
                    <option value="">Selecione o Autor</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo $usuario['id']; ?>">
                            <?php echo htmlspecialchars($usuario['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="data">Data</label>
                <input type="date" name="data" id="data" required>

                <label for="noticia">Notícia</label>
                <textarea name="noticia" id="noticia" rows="5" required></textarea>

                <label for="imagem">Imagem</label>
                <input type="file" name="imagem" id="imagem" accept=".jpeg, .png">

                <button type="submit">Salvar Notícia</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer">
            <p>&copy; 2024 Portal de Notícias | Todos os direitos reservados</p>
        </div>
    </footer>
</body>

</html>
