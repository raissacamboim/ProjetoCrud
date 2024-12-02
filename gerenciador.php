<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';
include_once './classes/Noticias.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    // Redirecionar para página de login caso não esteja logado
    header('Location: gerenciador.php');
    exit();
}

$noticias = new Noticias($db);

// Verificar se a URL contém um ID para excluir a notícia
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $noticia = new Noticias($db);
    $noticia->deletar($id);
    header('Location: portal.php');
    exit();
}

// Obter dados das notícias
$dados = $noticias->ler();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Notícias</title>
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
        }

        header {
            background: linear-gradient(135deg, #0062cc, #00c6ff);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #0047b3;
        }

        header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
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

        .main-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .news-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .news-item {
            width: calc(33.333% - 20px);
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .news-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .news-item h4 {
            font-size: 1.5rem;
            margin-top: 15px;
        }

        .news-item p {
            font-size: 1rem;
            margin-top: 10px;
        }

        .meta-info {
            font-size: 0.9rem;
            margin-top: 10px;
            color: #777;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            text-decoration: none;
            font-weight: bold;
            color: #f0f0f5;
            padding: 8px 12px;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .actions a:hover {
            background-color: #d32f2f;
            color: white;
        }

        .actions a.edit {
            background-color: green;
        }

        .actions a.edit:hover {
            background-color: #e68900;
        }

        .actions a.delete {
            background-color: #f44336;
        }

        .actions a.delete:hover {
            background-color: #d32f2f;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: white;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Portal de Notícias</h1>
        <h3>As últimas notícias em tempo real</h3>
        <div class="buttons">
            <button><a href="cadastronoticias.php">Cadastro de Notícias</a></button>
            <button><a href="logout.php">Sair</a></button>
            <button><a href="portal.php">Portal</a></button>
        </div>
    </header>

    <div class="main-container">
        <div class="news-list">
            <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="news-item">
                    <img src="./uploads/<?php echo $row['foto']; ?>" alt="Imagem da Notícia">
                    <h4><?php echo $row['titulo']; ?></h4>
                    <p><?php echo substr($row['noticia'], 0, 150); ?>...</p>
                    <div class="meta-info">
                        <span><strong>Autor:</strong> <?php echo $row['autor']; ?></span> |
                        <span><strong>Data:</strong> <?php echo $row['data']; ?></span>
                    </div>
                    <div class="actions">
                        <a href="./editarNoticias.php?id=<?php echo $row['id']; ?>" class="edit">Editar</a>
                        <a href="./deletarNot.php?id=<?php echo $row['id']; ?>" class="delete">Deletar</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <footer>
        <div class="footer">
            <p>&copy; 2024 Portal de Notícias | Todos os direitos reservados</p>
        </div>
    </footer>

</body>

</html>