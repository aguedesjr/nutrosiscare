<?
session_start();
//Requer autenticação
require_once ("validalogin.php");
//Requer conexão previa com o banco
require_once ("configs/conn.php");
//Classe usada para gerar o arquivo pdf
require_once ("fpdf16/fpdf.php");
//Caminho do arquivo de fontes para o FPDF
define('FPDF_FONTPATH','fpdf16/font/');

	class PDF extends FPDF
	{
		//Cabeçalho
		function Header()
		{
		    //Logo
		    //$this->Image('images/telefone.jpg',10,8,33);
		    //Coloca a fonte do título com Arial, negrito, 16
		    //$this->SetFont('Arial','B',16);
		    //Move para a direita
		    $this->Cell(65);
		    //Titulo
		    $this->Image('imagens/logo_prodom1.jpg',60,8,100); //Lateral, Vertical, Tamanho
		    //$this->Cell(65);
		    //$this->Cell(70,10,'Guia de Autorização',0,0,'C');
		    //Move para a direita
		    $this->Cell(70);
		    //Logo
		   //$this->Image('logo1.jpg',170,8,33);
		    //Quebra de linha
		    $this->Ln(30);
		}

		//Rodapé
		function Footer()
		{
		    //Posiciona a 1.5 cm do fim da pagina
		    $this->SetY(-15);
		    //Coloca a fonte do rodape com Arial, italico, 8
		    $this->SetFont('Arial','I',8);
		    //Numero da pagina
		    //$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
		    //if (isset($_GET["data"])){
  				//$data = utf8_decode($_GET["data"]);
			//}else {if (isset($_POST["data"])){
  				//$data = utf8_decode($_POST["data"]);
			//}};
		    //$this->Cell(0,10,utf8_decode('OBS: Valores sujeito a autorização do convênio acima citado.                                      Data: '.$data),0,0,'R');
		}
	}
	
	$usuario = $_SESSION[login];
	$mes1 = date("m");
	
	if (isset($_GET["profissional"])){
  		$profissional = utf8_decode($_GET["profissional"]);
	}else {if (isset($_POST["profissional"])){
  		$profissional = utf8_decode($_POST["profissional"]);
	}};
	
	if (isset($_GET["data"])){
  		$data = utf8_decode($_GET["data"]);
	}else {if (isset($_POST["data"])){
  		$data = utf8_decode($_POST["data"]);
	}};
	
	//Data no formato do banco de dados
	$datan = implode("-", array_reverse(explode("/", $data)));
	
	
	//Busca os horarios dos profissionais
	$sqlh = "SELECT nomepaciente, horario, id FROM agenda WHERE codprof = '$profissional' AND data = '$datan' ORDER BY horario";
	$resultadoh = mysql_query($sqlh);
	
	//Pega as informa��es na tabela profissionais com o profissional informado
	$sqlprof = "SELECT nome FROM profissionais WHERE id = '$profissional';";
	$resultadoprof = mysql_query($sqlprof);
	$resultprof = mysql_fetch_array($resultadoprof);
	
	//Instanciação da classe herdada
	$pdf=new PDF("P","mm","A4"); //P->Retrato, L->Paisagem; mm-> milímetros; A4-> padrão da folha
	$pdf->AliasNbPages(); //Recebe o total de páginas
	$pdf->AddPage(); //Coloca uma página em branco
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(65);
	$pdf->Cell(70,10,utf8_decode('Dr(a). '.$resultprof[0]),0,0,'C');
	$pdf->SetFont('Arial','B',12);
	$pdf->Ln(7);
	$pdf->Cell(65);
	$pdf->Cell(70,10,utf8_decode('Data: '.$data),0,0,'C');
	$pdf->SetFont('Arial','U',12);
	$pdf->Ln(7);
	$pdf->Cell(50,10,'                                                                                                                                                                  ',0,0);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(5);
	while ($linhash = mysql_fetch_array($resultadoh, MYSQL_NUM)){
		$pdf->Cell(50,10,utf8_decode('Nome: ').$linhash[0],0,0);
		$pdf->Cell(95);
		$pdf->Cell(50,10,utf8_decode('Horário: ').$linhash[1],0,0);
		$pdf->Ln(7);
		$pdf->Cell(5);
	};
	
	$pdf->Output("relatorioprofissional.pdf",D); //Gera o pdf e permite o download

?>
