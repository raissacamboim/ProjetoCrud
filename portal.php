<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
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
        padding: 0;
        margin: 0;
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
        margin-bottom: 10px;
        color: #fff;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
    }

    header h3 {
        font-size: 1.5rem;
        font-weight: 400;
        color: #fff;
        margin-top: 5px;
        font-style: italic;
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
        font-weight: 600;
        text-align: center;
        color: #333;
        margin-top: 30px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh;
    }

    button {
        background-color: #0062cc;
        border: none;
        color: white;
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        margin: 10px;
        transition: background 0.3s ease;
        display: inline-block;
    }

    button a {
        text-decoration: none;
        color: white;
    }

    button:hover {
        background-color: #0056b3;
    }

    button:active {
        background-color: #0042a0;
    }

   
    .footer {
        text-align: center;
        padding: 15px;
        background-color: #333;
        color: white;
        position: fixed;
        bottom: 0;
        width: 100%;

    }
</style>

<body>
    <header>
        <h1>Portal de Notícias</h1>
        <h3>As últimas notícias em tempo real</h3>
        <img src="" alt="">
        <div class="buttons">
            <button><a href="logout.php">Sair</a></button>

        </div>
    </header>

    <h2>O que deseja fazer?</h2>
    <div class="button-container">
        <button><a href="./gerenciaUsu.php">Gerencia Usuario</a></button>
        <button><a href="./gerenciador.php">Gerenciar Notícias</a></button>
    </div>


    <footer>
        <div class="footer">
            <p>&copy; 2024 Portal de Notícias | Todos os direitos reservados</p>
        </div>
    </footer>


</body>

</html>