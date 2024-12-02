<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

// Inicializar objeto de usuário e obter dados
$usuario = new Usuario($db);
$dados = $usuario->ler();

// Processar exclusão de usuário
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $usuario->deletar($id);
    header('Location: portal.php');
    exit();
}

// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];

// Obter dados dos usuários
$dados = $usuario->listarTodos();

// Função para determinar a saudação
function saudacao()
{
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } elseif ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Usuários</title>
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
            padding: 20px 0;
            text-align: center;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #0047b3;
            width: 100%;
            margin: 0;
        }

        header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
        }

        header h3 {
            font-size: 1.5rem;
            color: #fff;
            font-style: italic;
        }

        .buttons {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        .buttons a {
            background-color: #00c6ff;
            color: white;
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
            transition: background 0.3s ease;
        }

        .buttons a:hover {
            background-color: #009ec6;
        }

        .main-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .user-table th,
        .user-table td {
            padding: 12px;
            text-align: left;
        }

        .user-table th {
            background-color: #0062cc;
            color: white;
            font-weight: bold;
        }

        .user-table td {
            background-color: #f9f9f9;
        }

        .user-table td a {
            text-decoration: none;
            color: #00c6ff;
            font-weight: bold;
            margin-right: 10px;
        }

        .user-table td a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: white;
            margin-top: 40px;
            margin-top: 150px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Portal de Notícias</h1>
        <h3>As últimas atualizações e ações do sistema</h3>
        <div class="buttons">
            <a href="registrar.php">Adicionar Usuário</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div class="main-container">
        <h2><?php echo saudacao() . ", " . $nome_usuario; ?>!</h2>

        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sexo</th>
                    <th>Fone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo ($row['sexo'] === 'M') ? 'Masculino' : 'Feminino'; ?></td>
                        <td><?php echo $row['fone']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                            <a href="deletar.php?id=<?php echo $row['id']; ?>">Deletar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <div class="footer">
            <p>&copy; 2024 Portal de Notícias | Todos os direitos reservados</p>
        </div>
    </footer>

</body>

</html>