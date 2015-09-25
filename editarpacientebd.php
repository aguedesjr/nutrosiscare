<?
session_start();
//Requer autenticação
require_once ("validalogin.php");
//Requer conexão previa com o banco
require_once ("configs/conn.php");
//Classe usada para gerar log
//include ("geralog.class.php");
// Verifica o perfil do usuário logado
//if ($_SESSION["perfil"] <> "ADMIN"){
 // echo "Você não está autorizado a abrir esta página";
  //header("location:index.php");
  //exit;
//};

//$log = new MyLogPHP('./log/system.log'); //Inicia o objeto para geracao dos logs

//$ip = getenv('REMOTE_ADDR'); //Pega o IP do micro que está usando o sistema

// Verifica se as vaiáveis de POST ou GET existem;
if (isset($_GET["metodo"])){
  $metodo=$_GET["metodo"];
} else { if (isset($_POST["metodo"])){
$metodo = $_POST["metodo"];
}};

if (isset($_GET["nome"])){
  $nome = utf8_decode($_GET["nome"]);
}else {if (isset($_POST["nome"])){
  $nome = utf8_decode($_POST["nome"]);
}};
if (isset($_GET["matricula"])){
  $matricula = $_GET["matricula"];
}else {if (isset($_POST["matricula"])){
  $matricula = $_POST["matricula"];
}};
if (isset($_GET["cpf"])){
  $cpf = $_GET["cpf"];
}else {if (isset($_POST["cpf"])){
  $cpf = $_POST["cpf"];
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
if (isset($_GET["data"])){
  $data = $_GET["data"];
  $data = implode("-", array_reverse(explode("/", $data)));
}else {if (isset($_POST["data"])){
  $data = $_POST["data"];
  $data = implode("-", array_reverse(explode("/", $data)));
}};
if (isset($_GET["id"])){
  $id = $_GET["id"];
}else {if (isset($_POST["id"])){
  $id = $_POST["id"];
}};

$sql = "UPDATE pacientes SET nome='$nome', matricula='$matricula', data='$data', cpf='$cpf', endereco='$endereco', cep='$cep', bairro='$bairro', telefone='$tel', celular='$cel', cidade='$cidade', estado='$estado' WHERE id = '$id';";

// Executa o comando SQL
mysql_query($sql);
// Finaliza a conexão com o banco de dados
mysql_close($conexao);
// Redireciona para a página de usuários
header("location:buscarpaciente.php");
 ?>

