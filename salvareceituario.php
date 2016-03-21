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

//id das informações no banco de dados
if (isset($_GET["id"])){
	$id = utf8_decode($_GET["id"]);
}else {if (isset($_POST["id"])){
	$id = utf8_decode($_POST["id"]);
}};

//código de identificação do usuário
if (isset($_GET["codigo"])){
	$codigo = utf8_decode($_GET["codigo"]);
}else {if (isset($_POST["codigo"])){
	$codigo = utf8_decode($_POST["codigo"]);
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

if (isset($_GET["pesoatual"])){
	$pesoatual = utf8_decode($_GET["pesoatual"]);
}else {if (isset($_POST["pesoatual"])){
	$pesoatual = utf8_decode($_POST["pesoatual"]);
}};

if (isset($_GET["altura"])){
	$altura = utf8_decode($_GET["altura"]);
}else {if (isset($_POST["altura"])){
	$altura = utf8_decode($_POST["altura"]);
}};

if (isset($_GET["imc"])){
	$imc = utf8_decode($_GET["imc"]);
}else {if (isset($_POST["imc"])){
	$imc = utf8_decode($_POST["imc"]);
}};

if (isset($_GET["ca"])){
	$ca = utf8_decode($_GET["ca"]);
}else {if (isset($_POST["ca"])){
	$ca = utf8_decode($_POST["ca"]);
}};

if (isset($_GET["pesousual"])){
	$pesousual = utf8_decode($_GET["pesousual"]);
}else {if (isset($_POST["pesousual"])){
	$pesousual = utf8_decode($_POST["pesousual"]);
}};

if (isset($_GET["pesousual"])){
	$pesousual = utf8_decode($_GET["pesousual"]);
}else {if (isset($_POST["pesousual"])){
	$pesousual = utf8_decode($_POST["pesousual"]);
}};

if (isset($_GET["pa"])){
	$pa = utf8_decode($_GET["pa"]);
}else {if (isset($_POST["pa"])){
	$pa = utf8_decode($_POST["pa"]);
}};

if (isset($_GET["med"])){
	$med = utf8_decode($_GET["med"]);
}else {if (isset($_POST["med"])){
	$med = utf8_decode($_POST["med"]);
}};

if (isset($_GET["queixa"])){
	$queixa = utf8_decode($_GET["queixa"]);
}else {if (isset($_POST["queixa"])){
	$queixa = utf8_decode($_POST["queixa"]);
}};

if (isset($_GET["histopato"])){
	$histopato = utf8_decode($_GET["histopato"]);
}else {if (isset($_POST["histopato"])){
	$histopato = utf8_decode($_POST["histopato"]);
}};

if (isset($_GET["medreg"])){
	$medreg = utf8_decode($_GET["medreg"]);
}else {if (isset($_POST["medreg"])){
	$medreg = utf8_decode($_POST["medreg"]);
}};

if (isset($_GET["alergiamed"])){
	$alergiamed = utf8_decode($_GET["alergiamed"]);
}else {if (isset($_POST["alergiamed"])){
	$alergiamed = utf8_decode($_POST["alergiamed"]);
}};

if (isset($_GET["qualalergiamed"])){
	$qualalergiamed = utf8_decode($_GET["qualalergiamed"]);
}else {if (isset($_POST["qualalergiamed"])){
	$qualalergiamed = utf8_decode($_POST["qualalergiamed"]);
}};

if (isset($_GET["habint"])){
	$habint = utf8_decode($_GET["habint"]);
}else {if (isset($_POST["habint"])){
	$habint = utf8_decode($_POST["habint"]);
}};

if (isset($_GET["ativfis"])){
	$ativfis = utf8_decode($_GET["ativfis"]);
}else {if (isset($_POST["ativfis"])){
	$ativfis = utf8_decode($_POST["ativfis"]);
}};

if (isset($_GET["qualativfis"])){
	$qualativfis = utf8_decode($_GET["qualativfis"]);
}else {if (isset($_POST["qualativfis"])){
	$qualativfis = utf8_decode($_POST["qualativfis"]);
}};

if (isset($_GET["coltotal"])){
	$coltotal = utf8_decode($_GET["coltotal"]);
}else {if (isset($_POST["coltotal"])){
	$coltotal = utf8_decode($_POST["coltotal"]);
}};

if (isset($_GET["hdl"])){
	$hdl = utf8_decode($_GET["hdl"]);
}else {if (isset($_POST["hdl"])){
	$hdl = utf8_decode($_POST["hdl"]);
}};

if (isset($_GET["ldl"])){
	$ldl = utf8_decode($_GET["ldl"]);
}else {if (isset($_POST["ldl"])){
	$ldl = utf8_decode($_POST["ldl"]);
}};

if (isset($_GET["vldl"])){
	$vldl = utf8_decode($_GET["vldl"]);
}else {if (isset($_POST["vldl"])){
	$vldl = utf8_decode($_POST["vldl"]);
}};

if (isset($_GET["ht"])){
	$ht = utf8_decode($_GET["ht"]);
}else {if (isset($_POST["ht"])){
	$ht = utf8_decode($_POST["ht"]);
}};

if (isset($_GET["hb"])){
	$hb = utf8_decode($_GET["hb"]);
}else {if (isset($_POST["hb"])){
	$hb = utf8_decode($_POST["hb"]);
}};

if (isset($_GET["glicose"])){
	$glicose = utf8_decode($_GET["glicose"]);
}else {if (isset($_POST["glicose"])){
	$glicose = utf8_decode($_POST["glicose"]);
}};

if (isset($_GET["hbglicosada"])){
	$hbglicosada = utf8_decode($_GET["hbglicosada"]);
}else {if (isset($_POST["hbglicosada"])){
	$hbglicosada = utf8_decode($_POST["hbglicosada"]);
}};

if (isset($_GET["vcm"])){
	$vcm = utf8_decode($_GET["vcm"]);
}else {if (isset($_POST["vcm"])){
	$vcm = utf8_decode($_POST["vcm"]);
}};

if (isset($_GET["ureia"])){
	$ureia = utf8_decode($_GET["ureia"]);
}else {if (isset($_POST["ureia"])){
	$ureia = utf8_decode($_POST["ureia"]);
}};

if (isset($_GET["tgo"])){
	$tgo = utf8_decode($_GET["tgo"]);
}else {if (isset($_POST["tgo"])){
	$tgo = utf8_decode($_POST["tgo"]);
}};

if (isset($_GET["tgp"])){
	$tgp = utf8_decode($_GET["tgp"]);
}else {if (isset($_POST["tgp"])){
	$tgp = utf8_decode($_POST["tgp"]);
}};

if (isset($_GET["cpk"])){
	$cpk = utf8_decode($_GET["cpk"]);
}else {if (isset($_POST["cpk"])){
	$cpk = utf8_decode($_POST["cpk"]);
}};

if (isset($_GET["sodio"])){
	$sodio = utf8_decode($_GET["sodio"]);
}else {if (isset($_POST["sodio"])){
	$sodio = utf8_decode($_POST["sodio"]);
}};

if (isset($_GET["potassio"])){
	$potassio = utf8_decode($_GET["potassio"]);
}else {if (isset($_POST["potassio"])){
	$potassio = utf8_decode($_POST["potassio"]);
}};

if (isset($_GET["calcio"])){
	$calcio = utf8_decode($_GET["calcio"]);
}else {if (isset($_POST["calcio"])){
	$calcio = utf8_decode($_POST["calcio"]);
}};

if (isset($_GET["vitaminad"])){
	$vitaminad = utf8_decode($_GET["vitaminad"]);
}else {if (isset($_POST["vitaminad"])){
	$vitaminad = utf8_decode($_POST["vitaminad"]);
}};

if (isset($_GET["vitaminab12"])){
	$vitaminab12 = utf8_decode($_GET["vitaminab12"]);
}else {if (isset($_POST["vitaminab12"])){
	$vitaminab12 = utf8_decode($_POST["vitaminab12"]);
}};

if (isset($_GET["acidofolico"])){
	$acidofolico = utf8_decode($_GET["acidofolico"]);
}else {if (isset($_POST["acidofolico"])){
	$acidofolico = utf8_decode($_POST["acidofolico"]);
}};

if (isset($_GET["ptnc"])){
	$ptnc = utf8_decode($_GET["ptnc"]);
}else {if (isset($_POST["ptnc"])){
	$ptnc = utf8_decode($_POST["ptnc"]);
}};

if (isset($_GET["vhs"])){
	$vhs = utf8_decode($_GET["vhs"]);
}else {if (isset($_POST["vhs"])){
	$vhs = utf8_decode($_POST["vhs"]);
}};

if (isset($_GET["insulina"])){
	$insulina = utf8_decode($_GET["insulina"]);
}else {if (isset($_POST["insulina"])){
	$insulina = utf8_decode($_POST["insulina"]);
}};

if (isset($_GET["ptntotal"])){
	$ptntotal = utf8_decode($_GET["ptntotal"]);
}else {if (isset($_POST["ptntotal"])){
	$ptntotal = utf8_decode($_POST["ptntotal"]);
}};

if (isset($_GET["ttog"])){
	$ttog = utf8_decode($_GET["ttog"]);
}else {if (isset($_POST["ttog"])){
	$ttog = utf8_decode($_POST["ttog"]);
}};

if (isset($_GET["albumina"])){
	$albumina = utf8_decode($_GET["albumina"]);
}else {if (isset($_POST["albumina"])){
	$albumina = utf8_decode($_POST["albumina"]);
}};

if (isset($_GET["globulina"])){
	$globulina = utf8_decode($_GET["globulina"]);
}else {if (isset($_POST["globulina"])){
	$globulina = utf8_decode($_POST["globulina"]);
}};

if (isset($_GET["cafeusual"])){
	$cafeusual = utf8_decode($_GET["cafeusual"]);
}else {if (isset($_POST["cafeusual"])){
	$cafeusual = utf8_decode($_POST["cafeusual"]);
}};

if (isset($_GET["colacaousual"])){
	$colacaousual = utf8_decode($_GET["colacaousual"]);
}else {if (isset($_POST["colacaousual"])){
	$colacaousual = utf8_decode($_POST["colacaousual"]);
}};

if (isset($_GET["almocousual"])){
	$almocousual = utf8_decode($_GET["almocousual"]);
}else {if (isset($_POST["almocousual"])){
	$almocousual = utf8_decode($_POST["almocousual"]);
}};

if (isset($_GET["lancheusual"])){
	$lancheusual = utf8_decode($_GET["lancheusual"]);
}else {if (isset($_POST["lancheusual"])){
	$lancheusual = utf8_decode($_POST["lancheusual"]);
}};

if (isset($_GET["jantarusual"])){
	$jantarusual = utf8_decode($_GET["jantarusual"]);
}else {if (isset($_POST["jantarusual"])){
	$jantarusual = utf8_decode($_POST["jantarusual"]);
}};

if (isset($_GET["ceiausual"])){
	$ceiausual = utf8_decode($_GET["ceiausual"]);
}else {if (isset($_POST["ceiausual"])){
	$ceiausual = utf8_decode($_POST["ceiausual"]);
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

if (isset($_GET["naogosta"])){
	$naogosta = utf8_decode($_GET["naogosta"]);
}else {if (isset($_POST["naogosta"])){
	$naogosta = utf8_decode($_POST["naogosta"]);
}};

if (isset($_GET["conduta"])){
	$conduta = utf8_decode($_GET["conduta"]);
}else {if (isset($_POST["conduta"])){
	$conduta = utf8_decode($_POST["conduta"]);
}};

if (isset($_GET["obs"])){
	$obs = utf8_decode($_GET["obs"]);
}else {if (isset($_POST["obs"])){
	$obs = utf8_decode($_POST["obs"]);
}};

//-----------------------------------------------------------------------------------------------

//BLOCO SALVAR INFORMAÇÕES NO BD
//-----------------------------------------------------------------------------------------------
if ($opbd == "cadastrar"){
	// Salva as informações no banco de dados
	$sqli = "INSERT INTO recibo (nome, cpf, valor, valorex, data) VALUES ('$nome', '$cpf', '$valor', '$valorex', '$datan');";
	mysql_query($sqli);
	// Atualiza as informações no banco de dados
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
