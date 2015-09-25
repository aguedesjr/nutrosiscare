<?
session_start(); 
require_once ("validalogin.php");

//Requer conexão previa com o banco
require_once ("configs/conn.php");

$text = trim($_GET['codigo']);
$text1 = trim($_GET['convenio']);
$sql = "SELECT valor FROM procedimentos WHERE codigo = '$text' AND convenio = '$text1';";
$resultado = mysql_query($sql);

//Formatação do JSON
//$json = '[';
$first = true;
while ($linhas = mysql_fetch_array($resultado)){
	if (!$first) { $json .=  ','; } else { $first = false; }
	$json .= utf8_encode($linhas['valor']);
}
//$json .= ']';
echo $json;
//$result = array();

//while ( $row = mysql_fetch_assoc( $resultado ) ) {
	//$result[] = array(
		//'nome'	=> $row['nome'],
		//'valor'	=> $row['valor'],
	//);
//}

//echo( json_encode( $result ) );

?>