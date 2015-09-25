<?
session_start(); 
require_once ("validalogin.php");

//Requer conexão previa com o banco
require_once ("configs/conn.php");

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="imagens/icone.ico"/> <!-- ICONE DA PAGINA -->
    <script src="js/jquery.min.js"></script>        <!-- SCRIPT BASE -->
    <script src="js/jquery.widget.min.js"></script> <!-- SCRIPT BASE -->
    <script src="js/jquery.mousewheel.js"></script> <!-- SCRIPT BASE -->
    <script src="js/metro.min.js"></script>         <!-- SCRIPT BASE -->
    <script src="js/load-metro.js"></script>        <!-- SCRIPT BASE -->
    <script src="js/prettify/prettify.js"></script> <!-- SCRIPT BASE -->
    <script src="js/load-metro.js"></script>        <!-- Metro UI CSS JavaScript plugins -->
    <link href="css/metro-bootstrap.css" rel="stylesheet">            <!-- CSS BASE -->
    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet"> <!-- CSS BASE -->
    <link href="css/iconFont.css" rel="stylesheet">                   <!-- CSS BASE -->
    <meta charset="UTF-8"> <!-- CODIFICACAO -->
</head>