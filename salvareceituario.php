<?
//BLOCO REQUISITOS
//-----------------------------------------------------------------------------------------------
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
//-----------------------------------------------------------------------------------------------

//BLOCO DAS VARIAVEIS (fichareceituario.php)
//-----------------------------------------------------------------------------------------------
//Qual operação o banco de dados irá realizar (cadastrar/atualizar)
if (isset($_GET["opbd"])){
	$opbd = utf8_decode($_GET["opbd"]);
}else {if (isset($_POST["opbd"])){
	$opbd = utf8_decode($_POST["opbd"]);
}};

if (isset($_GET["nome"])){
	$nome = utf8_decode($_GET["nome"]);
}else {if (isset($_POST["nome"])){
	$nome = utf8_decode($_POST["nome"]);
}};

if (isset($_GET["convenio"])){
	$convenio = utf8_decode($_GET["convenio"]);
}else {if (isset($_POST["convenio"])){
	$convenio = utf8_decode($_POST["convenio"]);
}};

if (isset($_GET["id"])){
	$id = utf8_decode($_GET["id"]);
}else {if (isset($_POST["id"])){
	$id = utf8_decode($_POST["id"]);
}};

if (isset($_GET["cafe"])){
	$cafe = utf8_decode($_GET["cafe"]);
}else {if (isset($_POST["cafe"])){
	$cafe = utf8_decode($_POST["cafe"]);
}};

if (isset($_GET["colacao"])){
	$colacao = utf8_decode($_GET["colacao"]);
}else {if (isset($_POST["colacao"])){
	$colacao = utf8_decode($_POST["colacao"]);
}};

if (isset($_GET["almoco"])){
	$almoco = utf8_decode($_GET["almoco"]);
}else {if (isset($_POST["almoco"])){
	$almoco = utf8_decode($_POST["almoco"]);
}};

if (isset($_GET["lanche"])){
	$lanche = utf8_decode($_GET["lanche"]);
}else {if (isset($_POST["lanche"])){
	$lanche = utf8_decode($_POST["lanche"]);
}};

if (isset($_GET["jantar"])){
	$jantar = utf8_decode($_GET["jantar"]);
}else {if (isset($_POST["jantar"])){
	$jantar = utf8_decode($_POST["jantar"]);
}};

if (isset($_GET["ceia"])){
	$ceia = utf8_decode($_GET["ceia"]);
}else {if (isset($_POST["ceia"])){
	$ceia = utf8_decode($_POST["ceia"]);
}};

// Data para ser exibida no PDF
if (isset($_GET["data"])){
	$data = $_GET["data"];
}else {if (isset($_POST["data"])){
	$data = $_POST["data"];
}};	

// Data para ser salva no BD
if (isset($_GET["data"])){
	$datan = $_GET["data"];
	$datan = implode("-", array_reverse(explode("/", $datan)));
}else {if (isset($_POST["data"])){
	$datan = $_POST["data"];
	$datan = implode("-", array_reverse(explode("/", $datan)));
}};
//-----------------------------------------------------------------------------------------------

//BLOCO SALVAR INFORMAÇÕES NO BD
//-----------------------------------------------------------------------------------------------
if ($opbd == "cadastrar"){
	// Salva as informações no banco de dados
	$sqli = "INSERT INTO recibo (nome, cpf, valor, valorex, data) VALUES ('$nome', '$cpf', '$valor', '$valorex', '$datan');";
	mysql_query($sqli);
} elseif ($opbd == "atualizar"){
	$sqli = "";
	mysql_query($sqli);
}

//-----------------------------------------------------------------------------------------------


//BLOCO USO DO TEMPLATE DO PDF
//-----------------------------------------------------------------------------------------------
class PDF extends FPDI
{
	protected $_tplIdx;

	public function Header()
	{
		if (null === $this->_tplIdx) {
			$this->setSourceFile('fpdi/timbre.pdf');
			$this->_tplIdx = $this->importPage(1);
		}

		$this->useTemplate($this->_tplIdx);
	}
}
//-----------------------------------------------------------------------------------------------

//BLOCO CONFIGURAÇÕES DO PDF
//-----------------------------------------------------------------------------------------------
$pdf = new PDF(); // inicia FPDI
$pdf->SetTopMargin(65); // define o tamanho do topo
$pdf->AddPage(); // adiciona pagina
//-----------------------------------------------------------------------------------------------

//BLOCO NOME DA GUIA
//-----------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','B',14);
$pdf->Cell(58);
$pdf->Cell(20,10,utf8_decode('ORIENTAÇÕES NUTRICIONAIS'));
//-----------------------------------------------------------------------------------------------

//BLOCO NOME DO PACIENTE
//-----------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','',12);
$pdf->Ln(12);
$pdf->Cell(20);
$pdf->Cell(150,5,'Nome: '.$nome);
//-----------------------------------------------------------------------------------------------

//BLOCO CAFE DA MANHA
//-----------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','BU',12);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->Cell(20,10,utf8_decode('Café da Manhã:'));
$pdf->SetFont('Arial','',10);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->MultiCell(150,5,$cafe);
//-----------------------------------------------------------------------------------------------

//BLOCO COLAÇÃO
//-----------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','BU',12);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->Cell(20,10,utf8_decode('Colação:'));
$pdf->SetFont('Arial','',10);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->MultiCell(150,5,$colacao);
//-----------------------------------------------------------------------------------------------

//BLOCO ALMOÇO
//-----------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','BU',12);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->Cell(20,10,utf8_decode('Almoço:'));
$pdf->SetFont('Arial','',10);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->MultiCell(150,5,$almoco);
//-----------------------------------------------------------------------------------------------

//BLOCO LANCHE
//-----------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','BU',12);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->Cell(20,10,utf8_decode('Lanche:'));
$pdf->SetFont('Arial','',10);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->MultiCell(150,5,$lanche);
//-----------------------------------------------------------------------------------------------

//BLOCO JANTAR
//-----------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','BU',12);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->Cell(20,10,utf8_decode('Jantar:'));
$pdf->SetFont('Arial','',10);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->MultiCell(150,5,$jantar);
//-----------------------------------------------------------------------------------------------

//BLOCO CEIA
//-----------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','BU',12);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->Cell(20,10,utf8_decode('Ceia:'));
$pdf->SetFont('Arial','',10);
$pdf->Ln(8);
$pdf->Cell(20);
$pdf->MultiCell(150,5,$ceia);
//-----------------------------------------------------------------------------------------------

//BLOCO ASSINATURA
//-----------------------------------------------------------------------------------------------
$pdf->SetY(250);
$pdf->Cell(45);
$pdf->Cell(20,10,'_____________________________________________________');
$pdf->Ln(5);
$pdf->Cell(65);
$pdf->Cell(20,10,'Dra. Clarissa de Oliveira Soares Peixoto');
$pdf->Ln(5);
$pdf->Cell(85);
$pdf->Cell(20,10,'Data: '.$data);
//$pdf->Cell(20,10,'CPF: 030.771.727-55');
//-----------------------------------------------------------------------------------------------

$pdf->Output("recibo_".$nome.".pdf",D);
?>
