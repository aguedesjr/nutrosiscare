<?
session_start();
//Requer autenticação
require_once ("validalogin.php");
//Requer conexão previa com o banco
require_once ("configs/conn.php");
//Classe usada para gerar o arquivo pdf
require_once ("fpdf16/fpdf.php");
//Classe usada para gerar o arquivo pdf
require_once ("fpdi/fpdi.php");
//Caminho do arquivo de fontes para o FPDF
define('FPDF_FONTPATH','fpdf16/font/');

// Recebe os valores que vem da pagina recibo.php
if (isset($_GET["nome"])){
	$nome = utf8_decode($_GET["nome"]);
}else {if (isset($_POST["nome"])){
	$nome = utf8_decode($_POST["nome"]);
}};

if (isset($_GET["cpf"])){
	$cpf = utf8_decode($_GET["cpf"]);
}else {if (isset($_POST["nome"])){
	$cpf = utf8_decode($_POST["cpf"]);
}};

if (isset($_GET["valor"])){
	$valor = utf8_decode($_GET["valor"]);
}else {if (isset($_POST["valor"])){
	$valor = utf8_decode($_POST["valor"]);
}};

if (isset($_GET["cafe"])){
	$cafe = utf8_decode($_GET["cafe"]);
}else {if (isset($_POST["cafe"])){
	$cafe = utf8_decode($_POST["cafe"]);
}};

if (isset($_GET["data"])){
	$datan = $_GET["data"];
	$datan = implode("-", array_reverse(explode("/", $datan)));
}else {if (isset($_POST["data"])){
	$datan = $_POST["data"];
	$datan = implode("-", array_reverse(explode("/", $datan)));
}};

// Salva as informa��es no banco de dados
$sqli = "INSERT INTO recibo (nome, cpf, valor, valorex, data) VALUES ('$nome', '$cpf', '$valor', '$valorex', '$datan');";
mysql_query($sqli);

// initiate FPDI
$pdf = new FPDI();
// add a page
$pdf->AddPage();
// set the source file
$pdf->setSourceFile("fpdi/timbre.pdf");
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 0, 0, 210);

// now write some text above the imported page
$pdf->SetFont('Arial','B',14);
$pdf->Ln(60);
$pdf->Cell(85);
$pdf->Cell(20,10,'DIETA');
$pdf->SetFont('Arial','BU',12);
$pdf->Ln(15);
$pdf->Cell(20);
$pdf->Cell(20,10,utf8_decode('Café da Manhã:'));
$pdf->SetFont('Arial','',10);
$pdf->Ln(10);
$pdf->Cell(20);
$pdf->MultiCell(20,10,utf8_decode($cafe));
$pdf->SetY(250);
$pdf->Cell(45);
$pdf->Cell(20,10,'_____________________________________________________');
$pdf->Ln(5);
$pdf->Cell(65);
$pdf->Cell(20,10,'Dra. Clarissa de Oliveira Soares Peixoto');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->Cell(20,10,'CPF: 030.771.727-55');

$pdf->Output("recibo_".$nome.".pdf",D);
?>
