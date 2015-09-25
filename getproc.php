<?
session_start(); 
require_once ("validalogin.php");

//Requer conexão previa com o banco
require_once ("configs/conn.php");

//$text = trim($_GET['convenio']);
$text = mysql_real_escape_string($_GET['convenio']);
$sql = "SELECT nome, id FROM procedimentos WHERE convenio = '$text' ORDER BY nome ASC;";
$resultado = mysql_query($sql);

$cod = array();

while ( $row = mysql_fetch_assoc( $resultado ) ) {
	$cod[] = array(
		'nome'	=> utf8_encode($row['nome']),
		'id'	=> $row['id'],
	);
}

echo( json_encode( $cod ) );

?>