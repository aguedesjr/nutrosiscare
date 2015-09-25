<?
session_start();
//Requer autenticação
require_once ("validalogin.php");
//Requer conexão previa com o banco
require_once ("configs/conn.php");

// Verifica se as vaiáveis de POST ou GET existem;

if (isset($_GET["nome"])){
  $nome = utf8_decode($_GET["nome"]);
}else {if (isset($_POST["nome"])){
  $nome = utf8_decode($_POST["nome"]);
}};
if (isset($_GET["horario"])){
  $horario = utf8_decode($_GET["horario"]);
}else {if (isset($_POST["horario"])){
  $horario = utf8_decode($_POST["horario"]);
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

//Data no formato do banco de dados
$datan = implode("-", array_reverse(explode("/", $data)));

$sql = "INSERT INTO agenda (codprof,nomepaciente,data,horario) VALUES ('$profissional','$nome','$datan','$horario');"; 

// Executa o comando SQL
mysql_query($sql);
// Finaliza a conexão com o banco de dados
mysql_close($conexao);
// Redireciona para a página de usuários
//header("location:inicio.php");
header("location:buscaragenda.php?data=".$data."&profissional=".$profissional);
 ?>

