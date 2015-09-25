<?
session_start();
//Requer autenticação
require_once ("validalogin.php");
//Requer conexão previa com o banco
require_once ("configs/conn.php");

if (isset($_GET["id"])){
    $id = utf8_decode($_GET["id"]);
}else {if (isset($_POST["id"])){
    $id = utf8_decode($_POST["id"]);
}};
if (isset($_GET["profissional"])){
  $profissional = $_GET["profissional"];
}else {if (isset($_POST["profissional"])){
  $profissional = $_POST["profissional"];
}};
if (isset($_GET["data"])){
    $data = utf8_decode($_GET["data"]);
}else {if (isset($_POST["data"])){
    $data = utf8_decode($_POST["data"]);
}};

$sql = "DELETE FROM agenda WHERE id = '$id';";

// Executa o comando SQL
mysql_query($sql);
// Finaliza a conexão com o banco de dados
mysql_close($conexao);
// Redireciona para a página de usuários
//header("location:inicio.php");
header("location:buscaragenda.php?data=".$data."&profissional=".$profissional);
 ?>

