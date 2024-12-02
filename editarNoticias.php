<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
include_once './config/config.php';
include_once './classes/Noticias.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);
$usuarios = $usuario->listarTodos();

$noticia = new Noticias($db);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $noticia->lerPorId($id);
}



if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $id=$_POST['id']; 
    $titulo=$_POST['titulo']; 
    $autor=$_POST['autor'];
    $data=$_POST['data'];
    $mensagem=$_POST['noticia'];
    $imagem = $_FILES['foto'];
    
    //validação do upload da imagem
    $nomeImagem="";
    if($imagem['error']===UPLOAD_ERR_OK){
        $extensao=strtolower(pathinfo($imagem['name'],
        PATHINFO_EXTENSION));
        $tamanho=10*1024*1024;//10mb
        //validar tib de arquivo
        $tiposPermitdos=['jpg','jpeg','png'];
        if(!in_array($extensao, $tiposPermitdos)){
            die("Apenas arquivos Jpg ou png são permitidos");
        }
        if($imagem['size']>$tamanho){
            die("O tamanho do arquivo não pode exercer 10 MB");
        }
        //gerar nome único para o arquivo 
        $nomeImagem = uniqid().".".$extensao;
        $destino = "./uploads/".$nomeImagem;
        //mover o arquivo para o diretório
        if(!move_uploaded_file($imagem['tmp_name'],
        $destino)){
            die("Erro ao Salvar a Imagem");

        }else if ($imagem['error']!== UPLOAD_ERR_NO_FILE){
        //    die("Erro ao fazer Upload da imagem");
        }
    }

    //$id, $titulo, $autor, $data, $noticia, $foto)
    //var_dump($id, $titulo, $autor, $data, $noticia, $nomeImagem);
   // exit;
    $noticia->atualizar($id, $titulo, $autor, $data, $mensagem, $nomeImagem);
    header('Location: portal.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Notícias</title>
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
            height: calc(100vh - 40px);
            padding: 20px;
            margin-top: 100px;
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
            margin-top: 100px;
            width: 100%;
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
<h1>Editar Notícias</h1>
        <h3>Edite suas Notícias</h3>
    </header>
    
    <div class="container">
    <div class="box">
    <form method="POST"  enctype="multipart/form-data">
                <div class="form-title">
                    <h3>Cadastro de Notícias</h3>
                </div>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo"  value="<?php echo $row['titulo']; ?>" required>

                <label for="autor">Autor</label>
                <select name="autor" id="autor"  required>
                    <option  value="">Selecione o Autor</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo $usuario['id']; ?>">
                            <?php echo htmlspecialchars($usuario['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="data">Data</label>
                <input type="date" name="data" id="data"  value="<?php echo $row['data']; ?>" required>

                <label for="noticia">Notícia</label>
                <textarea name="noticia" id="noticia" rows="5" value="<?php echo $row['noticia']; ?>"  required></textarea>

                <label for="imagem">Imagem</label>
                <input type="file" name="foto" id="imagem"   value="<?php echo $row['foto']; ?>" accept=".jpeg, .png">

                <button type="submit">Editar Notícia</button>
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