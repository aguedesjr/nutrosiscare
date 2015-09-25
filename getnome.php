<?
session_start(); 
require_once ("validalogin.php");

//Requer conexão previa com o banco
require_once ("configs/conn.php");

//$text = trim($_GET['convenio']);
$text = mysql_real_escape_string($_GET['codigo']);
$sql = "SELECT nome FROM pacientes WHERE codigo = '$text';";
$resultado = mysql_query($sql);

$cod = array();

while ( $row = mysql_fetch_assoc( $resultado ) ) {
    $cod[] = array(
        'nome'    => $row['nome'],
    );
}

echo( json_encode( $cod ) );

?>