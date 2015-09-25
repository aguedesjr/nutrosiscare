<?
session_start(); 
require_once ("validalogin.php");

//Requer conexão previa com o banco
require_once ("configs/conn.php");

$sql = "SELECT codigo, nome FROM pacientes ORDER BY codigo;";
$resultado = mysql_query($sql);

//Formatação do JSON
//$json = '"aaData": [';
$first = true;
while ($linhas = mysql_fetch_array($resultado)){
    if (!$first) { $json .=  ','; } else { $first = false; }
   // $json .= utf8_encode($linhas['codigo']);
    $json .= utf8_encode($linhas['nome']);
}
//$json .= ']';
echo $json;
//$result = array();

//while ( $row = mysql_fetch_assoc( $resultado ) ) {
    //$result[] = array(
        //'nome'    => $row['nome'],
        //'valor'   => $row['valor'],
    //);
//}

//echo( json_encode( $result ) );

?>