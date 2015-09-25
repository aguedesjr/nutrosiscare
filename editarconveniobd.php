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
if (isset($_GET["contato"])){
  $contato = utf8_decode($_GET["contato"]);
}else {if (isset($_POST["contato"])){
  $contato = utf8_decode($_POST["contato"]);
}};
if (isset($_GET["cnpj"])){
  $cnpj = $_GET["cnpj"];
}else {if (isset($_POST["cnpj"])){
  $cnpj = $_POST["cnpj"];
}};
if (isset($_GET["rua"])){
  $endereco = utf8_decode($_GET["rua"]);
}else {if (isset($_POST["rua"])){
  $endereco = utf8_decode($_POST["rua"]);
}};
if (isset($_GET["cep"])){
  $cep = $_GET["cep"];
}else {if (isset($_POST["cep"])){
  $cep = $_POST["cep"];
}};
if (isset($_GET["bairro"])){
  $bairro = utf8_decode($_GET["bairro"]);
}else {if (isset($_POST["bairro"])){
  $bairro = utf8_decode($_POST["bairro"]);
}};
if (isset($_GET["tel"])){
  $tel = $_GET["tel"];
}else {if (isset($_POST["tel"])){
  $tel = $_POST["tel"];
}};
if (isset($_GET["cel"])){
  $cel = $_GET["cel"];
}else {if (isset($_POST["cel"])){
  $cel = $_POST["cel"];
}};
if (isset($_GET["cidade"])){
  $cidade = utf8_decode($_GET["cidade"]);
}else {if (isset($_POST["cidade"])){
  $cidade = utf8_decode($_POST["cidade"]);
}};
if (isset($_GET["estado"])){
  $estado = utf8_decode($_GET["estado"]);
}else {if (isset($_POST["estado"])){
  $estado = utf8_decode($_POST["estado"]);
}};
if (isset($_GET["telcom"])){
  $telcom = $_GET["telcom"];
}else {if (isset($_POST["telcom"])){
  $telcom = $_POST["telcom"];
}};
if (isset($_GET["id"])){
  $id = $_GET["id"];
}else {if (isset($_POST["id"])){
  $id = $_POST["id"];
}};

//Realiza a atualizacao das informacoes no BD
$sql = "UPDATE convenios SET nome='$nome', contato='$contato', telcom='$telcom', cnpj='$cnpj', endereco='$endereco', cep='$cep', bairro='$bairro', telefone='$tel', celular='$cel', cidade='$cidade', estado='$estado' WHERE id = '$id';";

// Executa o comando SQL
mysql_query($sql);
// Finaliza a conexão com o banco de dados
mysql_close($conexao);
// Redireciona para a página de usuários
header("location:buscarconvenio.php");
 ?>

