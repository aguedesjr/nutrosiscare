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
$pdf->SetFont('Arial','U',10);
$pdf->Ln(60);
$pdf->Cell(20);
$pdf->MultiCell(150,10,'This is just a simple text bbbbbbbbbbb bbbbbbbbbb bbbbbbbbbbbbbbbbbbbbbb bbbbbbbbbbbbbbbbbbbbbbbb bbbbbbbbbbbbbbbbbbbbbbb',1,J);

$pdf->Output("recibo.pdf",D);
?>
