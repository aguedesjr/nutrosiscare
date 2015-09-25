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
		    $this->Image('imagens/logo_prodom1.jpg',115,8,70); //Lateral, Vertical, Tamanho
		    //$this->Cell(65);
		    //$this->Cell(70,10,'Guia de Autorização',0,0,'C');
		    //Move para a direita
		    $this->Cell(70);
		    //Logo
		   //$this->Image('logo1.jpg',170,8,33);
		    //Quebra de linha
		    $this->Ln(17);
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
	
	$texto1 = "Esta seção será preenchida de acordo com as condições odontológicas com que o(a) paciente se apresentou no início do tratamento, sendo que serão descritas: - a presença e ausencia de dentes - as patologias extistentes; os trabalhos presentes, bem como as faces envolvidas, o material utilizado e a situação atual dos mesmos, bem como outas situações encontradas que o(a) cirurgião(ã)-dentista julgar necessário relatar.";
	
	$texto2 = "Dentes: (assinalar c/ um círculo quando o dente for dedículo)";
	
	$opcao = 'Data:__________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________                                                                                             _____ de __________________ de 20_____                  __________________________________________                     Ass. Paciente ou Res. Legal';
	
	if (isset($_GET["codigo"])){
  		$codigo = utf8_decode($_GET["codigo"]);
	}else {if (isset($_POST["codigo"])){
  		$codigo = utf8_decode($_POST["codigo"]);
	}};
	
	if (isset($_GET["data"])){
  		$data = utf8_decode($_GET["data"]);
	}else {if (isset($_POST["data"])){
  		$data = utf8_decode($_POST["data"]);
	}};
	
	if (isset($_GET["convenio"])){
  		$convenio = utf8_decode($_GET["convenio"]);
	}else {if (isset($_POST["convenio"])){
  		$convenio = utf8_decode($_POST["convenio"]);
	}};
	
	if (isset($_GET["profissional"])){
  		$profissional = utf8_decode($_GET["profissional"]);
	}else {if (isset($_POST["profissional"])){
  		$profissional = utf8_decode($_POST["profissional"]);
	}};
	
	if (isset($_GET["endereco"])){
  		$endereco = utf8_decode($_GET["endereco"]);
	}else {if (isset($_POST["endereco"])){
  		$endereco = utf8_decode($_POST["endereco"]);
	}};
	
	if (isset($_GET["bairro"])){
  		$bairro = utf8_decode($_GET["bairro"]);
	}else {if (isset($_POST["bairro"])){
  		$bairro = utf8_decode($_POST["bairro"]);
	}};
	
	if (isset($_GET["tel"])){
  		$tel = utf8_decode($_GET["tel"]);
	}else {if (isset($_POST["tel"])){
  		$tel = utf8_decode($_POST["tel"]);
	}};
	
	$sql = "SELECT nome, endereco, bairro, telefone, celular FROM pacientes WHERE codigo = '$codigo';";
	$resultado = mysql_query($sql);
	$result = mysql_fetch_array($resultado);
    
    $sqlcon = "SELECT nome FROM convenios WHERE id = '$convenio';";
    $resultadocon = mysql_query($sqlcon);
    $resultcon = mysql_fetch_array($resultadocon);
		
	//Instanciação da classe herdada
	$pdf=new PDF("L","mm","A4"); //P->Retrato, L->Paisagem; mm-> milímetros; A4-> padrão da folha
	//$pdf = new MEM_IMAGE;
	$pdf->AliasNbPages(); //Recebe o total de páginas
	$pdf->AddPage(); //Coloca uma página em branco
	$pdf->Line(148,40,148,210); //Adiciona a linha no centro da pagina
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(105);
	$pdf->Cell(70,10,utf8_decode('Prontuário Odontológico'),0,0,'C');
	$pdf->SetFont('Arial','U',8);
	$pdf->Ln(7);
	$pdf->Cell(50,10,'                                                                                                                                                                            ',0,0);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','U',8);
	$pdf->Cell(1);
	$pdf->Cell(50,10,'Nome: '.$result[0],0,0);
	$pdf->Cell(50);
	$pdf->Cell(50,10,'Data da Aval.: '.$data,0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(0,7,utf8_decode('Observações: (anotações do CD)'),0,0);
	$pdf->Ln(7);
	$pdf->Cell(1);
	$pdf->Cell(70,10,utf8_decode('Endereço: ').$result[1],0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(0,7,'______________________________________________________________________________________',0,0);
	$pdf->Ln(7);
	$pdf->Cell(1);
	$pdf->Cell(50,10,utf8_decode('Convênio: ').$resultcon[0],0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(0,7,'______________________________________________________________________________________',0,0);
	$pdf->Ln(7);
	$pdf->Cell(1);
	$pdf->Cell(30,10,utf8_decode('Telefone: ').$result[3],0,0);
	$pdf->Cell(20);
	$pdf->Cell(30,10,utf8_decode('Celular: ').$result[4],0,0);
	$pdf->Cell(20);
	$pdf->Cell(50,10,utf8_decode('Bairro: ').$result[2],0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(0,7,'______________________________________________________________________________________',0,0);
	$pdf->Ln(7);
	$pdf->Cell(50,10,'                                                                                                                                                                            ',0,0);
	$pdf->SetX(149);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(1);
	$pdf->Cell(10,10,'Planejamento do Tratamento:',0,0);
	$pdf->Ln(7);
	$pdf->SetFont('Arial','BIU',10);
	$pdf->Cell(45);
	$pdf->Cell(0,10,utf8_decode('Seção de Identificação Legal'),0,0);
    $pdf->SetX(149);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(1);    
    $pdf->Cell(70,7,utf8_decode('1ª OPÇÃO'),1,0,'C');
    $pdf->Cell(70,7,utf8_decode('2ª OPÇÃO'),1,0,'C');
    $pdf->Ln(7);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(1);
	$pdf->MultiCell(135,5,utf8_decode($texto1));
	$pdf->Ln(2);
	$pdf->Cell(1);
	$pdf->MultiCell(135,5,utf8_decode($texto2));
	$pdf->Ln(3);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'18-_________________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'38-_________________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'17-_________________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'37-_________________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'16-_________________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'36-_________________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'15/55-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'35/75-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'14/54-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'34/74-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'13/53-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'33/73-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'12/52-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'32/72-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'11/51-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'31/71-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'21/61-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'41/81-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'22/62-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'42/82-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'23/63-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'43/83-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'24/64-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'44/84-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'25/65-_______________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'45/85-_______________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'26-_________________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'46-_________________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'27-_________________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'47-_________________________________',0,0);
	$pdf->Ln(4);
	$pdf->Cell(1);
	$pdf->Cell(10,7,'28-_________________________________',0,0);
	$pdf->Cell(52);
	$pdf->Cell(10,7,'48-_________________________________',0,0);
	$pdf->Ln(10);
	$pdf->Cell(10);
	
	//$pdf->Ln(7);
	//$pdf->Cell(10);
	//$pdf->Cell(0,7,'__________________________________________________________________________',0,0);
	//$pdf->Cell(10);
	//$pdf->Cell(0,7,'__________________________________________________________________________',0,0);
	//$pdf->Cell(10);
	//$pdf->Cell(0,7,'__________________________________________________________________________',0,0);
	//$pdf->Cell(10);
	//$pdf->Cell(0,10,'Odontograma:',0,1);
	//$pdf->Image('imagens/odontograma.png',40,80,130); //Lateral, Vertical, Tamanho	    
	//$pdf->Ln(90);
	//$pdf->Cell(10);
	//$pdf->Cell(10,10,'Planejamento do Tratamento',0,0);
	//$pdf->Ln(10);
	//$pdf->Cell(10);
	//$pdf->Cell(85,7,utf8_decode('1ª OPÇÃO'),1,0,'C');
	//$pdf->Cell(85,7,utf8_decode('2ª OPÇÃO'),1,1,'C');
	//$pdf->Cell(10);
	//$pdf->SetFont('Arial','',10);
	//posiciona verticalmente
    $pdf->SetY("83");
    //posiciona horizontalmente
    $pdf->SetX("150");
	$pdf->MultiCell(70,7,$opcao,1);
	//posiciona verticalmente
    $pdf->SetY("83");
    //posiciona horizontalmente
    $pdf->SetX("220");
	$pdf->MultiCell(70,7,$opcao,1);		
	$pdf->Output("prontuario_odontologico".$result[0].".pdf",D); //Gera o pdf e permite o download

?>
