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
	
	if (isset($_GET["mes"])){
  		$mesatual = utf8_decode($_GET["mes"]);
	}else {if (isset($_POST["mes"])){
  		$mesatual = utf8_decode($_POST["mes"]);
	}};
	
	if (isset($_GET["ano"])){
  		$anoatual = utf8_decode($_GET["ano"]);
	}else {if (isset($_POST["ano"])){
  		$anoatual = utf8_decode($_POST["ano"]);
	}};
	
	switch ($mesatual) {
				case "01": $mes2 = Janeiro; break;
				case "02": $mes2 = Fevereiro; break;
				case "03": $mes2 = Março; break;
				case "04": $mes2 = Abril; break;
				case "05": $mes2 = Maio; break;
				case "06": $mes2 = Junho; break;
				case "07": $mes2 = Julho; break;
				case "08": $mes2 = Agosto; break;
				case "09": $mes2 = Setembro; break;
				case "10": $mes2 = Outubro; break;
				case "11": $mes2 = Novembro; break;
				case "12": $mes2 = Dezembro; break;
			};
	
	//Pega as informa��es na tabela procodont com o profissional informado
	$sql = "SELECT nomepaciente, procedimento, data FROM procodont WHERE profissional = '$profissional' AND data LIKE '$anoatual-$mesatual-%';";
	$resultado = mysql_query($sql);
	
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
	$pdf->Cell(70,10,utf8_decode('Relatório por Profissional'),0,0,'C');
	$pdf->SetFont('Arial','U',12);
	$pdf->Ln(7);
	$pdf->Cell(50,10,'                                                                                                                                                                  ',0,0);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','U',12);
	$pdf->Cell(15);
	$pdf->Cell(50,10,utf8_decode('Profissional: ').$resultprof[0],0,0);
	$pdf->Ln(7);
	$pdf->Cell(15);
	$pdf->Cell(30,10,utf8_decode('Mês: ').utf8_decode($mes2),0,0);
	$pdf->Cell(10);
	$pdf->Cell(30,10,utf8_decode('Ano: ').$anoatual,0,0);
	$pdf->Ln(7);
	$pdf->Cell(50,10,'                                                                                                                                                                  ',0,0);
	$pdf->Ln(15);
	$pdf->SetFont('Arial','BIU',14);
	$pdf->Cell(85);
	$pdf->Cell(0,10,utf8_decode('Serviços'),0,1);
	$pdf->SetFont('Arial','U',12);
	$pdf->Cell(15);
	$pdf->Cell(10,10,utf8_decode('Data'),0,0);
	$pdf->Cell(13);
	$pdf->Cell(50,10,'Paciente',0,0);
	$pdf->Cell(65);
	$pdf->Cell(16,10,'Valor',0,0);
	$pdf->Ln(10);
	while ($rel = mysql_fetch_array($resultado, MYSQL_NUM)){
	    	$pdf->SetFont('Arial','',12);	
	    	$pdf->Cell(10);
		//Escreve a data da consulta
			//Ajusta a data para ser exibida no formato dd/mm/aaaa
			$datan = implode("/", array_reverse(explode("-", $rel[2])));
			$pdf->Cell(10,10,$datan,0,0);
	    	$pdf->Cell(18);
			//Busca o nome dos pacientes
			$sqlp = "SELECT nome FROM pacientes WHERE id = '$rel[0]';";
			$resultadop = mysql_query($sqlp);
			$resultp = mysql_fetch_array($resultadop);
			//Escreve o nome do paciente
			$pdf->Cell(17,10,$resultp[0],0,0);
	    	$pdf->Cell(98);
			//Busca o valor do procedimento
			$sqlp = "SELECT valor FROM procedimentos WHERE codigo = '$rel[1]';";
			$resultadop = mysql_query($sqlp);
			$resultp = mysql_fetch_array($resultadop);
			//Escreve o valor no relat�rio
			$pdf->Cell(17,10,'R$ '.$resultp[0],0,0);
			$pdf->Ln(10);
			//Converte para o formato para ser calculado o valor pelo sistema
			$v1 = str_replace(".","",$resultp[0]);
			$v1 = str_replace(",",".",$v1);
			$acu = $acu + $v1;
	};	    
	$pdf->SetFont('Arial','U',12);
	$pdf->Ln(2);
	$pdf->Cell(50,10,'                                                                                                                                                                  ',0,0);
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(18);
	$pdf->Cell(125);
	$pdf->Cell(10,10,'Total: R$ '.number_format($acu,2,',','.'),0,0);
	$pdf->Output("relatorioprofissional.pdf",D); //Gera o pdf e permite o download

?>
