<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</style>

<body>
    <header>
        <h1>Portal de Notícias</h1>
        <img src="" alt="">
        <div class="buttons">
            <button><a href="login.php">Login</a></button>

        </div>
    </header>


</body>

</html>