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
if (isset($_GET["codigo"])){
  $codigo = utf8_decode($_GET["codigo"]);
}else {if (isset($_POST["codigo"])){
  $codigo = utf8_decode($_POST["codigo"]);
}};
if (isset($_GET["valor"])){
  $valor = $_GET["valor"];
}else {if (isset($_POST["valor"])){
  $valor = $_POST["valor"];
}};
if (isset($_GET["convenio"])){
  $convenio = utf8_decode($_GET["convenio"]);
}else {if (isset($_POST["convenio"])){
  $convenio = utf8_decode($_POST["convenio"]);
}};
if (isset($_GET["grupo"])){
  $grupo = utf8_decode($_GET["grupo"]);
}else {if (isset($_POST["grupo"])){
  $grupo = utf8_decode($_POST["grupo"]);
}};

// Grava as informações no BD
$sql = "INSERT INTO procedimentos (nome,codigo,valor,convenio,grupo) VALUES ('$nome','$codigo','$valor','$convenio','$grupo');";
    
// Executa o comando SQL
mysql_query($sql);
// Finaliza a conexão com o banco de dados
mysql_close($conexao);
// Redireciona para a página de usuários
header("location:cadastrarprocedimento.php");
 ?>

