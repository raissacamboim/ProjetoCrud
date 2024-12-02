<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
include_once './config/config.php';
include_once './classes/Noticias.php';


$noticias = new Noticias($db);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $noticias->deletar($id);
    header('Location: gerenciador.php');
    exit();
}
?>
