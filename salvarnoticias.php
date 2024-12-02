<?php
require_once "./classes/Noticias.php"; 
require_once "./config/config.php"; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   
    $titulo=$_POST['titulo']; 
    $autor=$_POST['autor'];
    $data=$_POST['data'];
    $noticia=$_POST['noticia'];
    $imagem =$_FILES['foto'];
    
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
        $noticiaObj =new Noticias($db);
        $noticiaObj->registrar($titulo, $autor, $data, $noticia, $nomeImagem,);
        echo"Notícia salva com Sucesso!";
        echo"<br><a href='index.php'>Voltar</a>";
    }
}
?>
