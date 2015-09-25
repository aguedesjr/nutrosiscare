<?
session_start();
//Requer autenticação
require_once ("validalogin.php");
//Requer conexão previa com o banco
require_once ("configs/conn.php");

// Verifica se as vaiáveis de POST ou GET existem;

if (isset($_GET["id"])){
    $id = utf8_decode($_GET["id"]);
}else {if (isset($_POST["id"])){
    $id = utf8_decode($_POST["id"]);
}};

// Grava as informações no BD
$sql = "DELETE FROM procedimentos WHERE id = '$id';";
    
// Executa o comando SQL
mysql_query($sql);
// Finaliza a conexão com o banco de dados
mysql_close($conexao);
// Redireciona para a página de usuários
header("location:buscarprocedimentoexcluir.php");
 ?>

