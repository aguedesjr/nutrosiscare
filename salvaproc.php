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
		    $this->Image('imagens/logo_prodom1.jpg',43,8,70); //Lateral, Vertical, Tamanho
		    $this->Image('imagens/logo_prodom1.jpg',180,8,70); //Lateral, Vertical, Tamanho
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
	
	switch (date("m")) {
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
	
	$dia1 = date("d");
	$ano1 = date("Y");
	
	$usuario = $_SESSION[login];
	$mes1 = date("m");
	//Realiza a consulta das receitas
	//$sql = "SELECT nome, valor, data FROM receitas WHERE user = '$usuario' AND data LIKE '%-$mes1-%';";
	//$resultado = mysql_query($sql);
	//Realiza a consulta das despesas
	//$sqld = "SELECT nome, valor, data FROM despesas WHERE user = '$usuario' AND data LIKE '%-$mes1-%';";
	//$resultadod = mysql_query($sqld);
	
	if (isset($_GET["codigo"])){
  		$codigo = utf8_decode($_GET["codigo"]);
	}else {if (isset($_POST["codigo"])){
  		$codigo = utf8_decode($_POST["codigo"]);
	}};
	
	//Retorna o ID do nome informado
	if (isset($_GET["nome"])){
  		$nome = utf8_decode($_GET["nome"]);
	}else {if (isset($_POST["nome"])){
  		$nome = utf8_decode($_POST["nome"]);
	}};
	
	//if (isset($_GET["data"])){
  		//$data = utf8_decode($_GET["data"]);
	//}else {if (isset($_POST["data"])){
  		//$data = utf8_decode($_POST["data"]);
	//}};
	
	if (isset($_GET["convenio"])){
  		$convenio = utf8_decode($_GET["convenio"]);
	}else {if (isset($_POST["convenio"])){
  		$convenio = utf8_decode($_POST["convenio"]);
	}};
	
	//Retorna o ID do convenio informado
	//if (isset($_GET["convenio1"])){
  		//$convenio1 = utf8_decode($_GET["convenio1"]);
	//}else {if (isset($_POST["convenio1"])){
  		//$convenio1 = utf8_decode($_POST["convenio1"]);
	//}};
	
	if (isset($_GET["profissional"])){
  		$profissional = utf8_decode($_GET["profissional"]);
	}else {if (isset($_POST["profissional"])){
  		$profissional = utf8_decode($_POST["profissional"]);
	}};
	
	if (isset($_GET["codconvenio"])){
  		$codconvenio = utf8_decode($_GET["codconvenio"]);
	}else {if (isset($_POST["codconvenio"])){
  		$codconvenio = utf8_decode($_POST["codconvenio"]);
	}};
	
	if (isset($_GET["proc"])){
  		$proc = utf8_decode($_GET["proc"]);
	}else {if (isset($_POST["proc"])){
  		$proc = utf8_decode($_POST["proc"]);
	}};
	
	if (isset($_GET["dente"])){
  		$dente = utf8_decode($_GET["dente"]);
	}else {if (isset($_POST["dente"])){
  		$dente = utf8_decode($_POST["dente"]);
	}};
	
	if (isset($_GET["valor"])){
  		$valor = utf8_decode($_GET["valor"]);
	}else {if (isset($_POST["valor"])){
  		$valor = utf8_decode($_POST["valor"]);
	}};
	
	if (isset($_GET["codconvenio2"])){
  		$codconvenio2 = utf8_decode($_GET["codconvenio2"]);
	}else {if (isset($_POST["codconvenio2"])){
  		$codconvenio2 = utf8_decode($_POST["codconvenio2"]);
	}};
	
	if (isset($_GET["proc2"])){
  		$proc2 = utf8_decode($_GET["proc2"]);
	}else {if (isset($_POST["proc2"])){
  		$proc2 = utf8_decode($_POST["proc2"]);
	}};
	
	if (isset($_GET["dente2"])){
  		$dente2 = utf8_decode($_GET["dente2"]);
	}else {if (isset($_POST["dente2"])){
  		$dente2 = utf8_decode($_POST["dente2"]);
	}};
	
	if (isset($_GET["valor2"])){
  		$valor2 = utf8_decode($_GET["valor2"]);
	}else {if (isset($_POST["valor2"])){
  		$valor2 = utf8_decode($_POST["valor2"]);
	}};
	
	if (isset($_GET["codconvenio3"])){
  		$codconvenio3 = utf8_decode($_GET["codconvenio3"]);
	}else {if (isset($_POST["codconvenio3"])){
  		$codconvenio3 = utf8_decode($_POST["codconvenio3"]);
	}};
	
	if (isset($_GET["proc3"])){
  		$proc3 = utf8_decode($_GET["proc3"]);
	}else {if (isset($_POST["proc3"])){
  		$proc3 = utf8_decode($_POST["proc3"]);
	}};
	
	if (isset($_GET["dente3"])){
  		$dente3 = utf8_decode($_GET["dente3"]);
	}else {if (isset($_POST["dente3"])){
  		$dente3 = utf8_decode($_POST["dente3"]);
	}};
	
	if (isset($_GET["valor3"])){
  		$valor3 = utf8_decode($_GET["valor3"]);
	}else {if (isset($_POST["valor3"])){
  		$valor3 = utf8_decode($_POST["valor3"]);
	}};
	
	if (isset($_GET["codconvenio4"])){
  		$codconvenio4 = utf8_decode($_GET["codconvenio4"]);
	}else {if (isset($_POST["codconvenio4"])){
  		$codconvenio4 = utf8_decode($_POST["codconvenio4"]);
	}};
	
	if (isset($_GET["proc4"])){
  		$proc4 = utf8_decode($_GET["proc4"]);
	}else {if (isset($_POST["proc4"])){
  		$proc4 = utf8_decode($_POST["proc4"]);
	}};
	
	if (isset($_GET["dente4"])){
  		$dente4 = utf8_decode($_GET["dente4"]);
	}else {if (isset($_POST["dente4"])){
  		$dente4 = utf8_decode($_POST["dente4"]);
	}};
	
	if (isset($_GET["valor4"])){
  		$valor4 = utf8_decode($_GET["valor4"]);
	}else {if (isset($_POST["valor4"])){
  		$valor4 = utf8_decode($_POST["valor4"]);
	}};
	
	if (isset($_GET["codconvenio5"])){
  		$codconvenio5 = utf8_decode($_GET["codconvenio5"]);
	}else {if (isset($_POST["codconvenio5"])){
  		$codconvenio5 = utf8_decode($_POST["codconvenio5"]);
	}};
	
	if (isset($_GET["proc5"])){
  		$proc5 = utf8_decode($_GET["proc5"]);
	}else {if (isset($_POST["proc5"])){
  		$proc5 = utf8_decode($_POST["proc5"]);
	}};
	
	if (isset($_GET["dente5"])){
  		$dente5 = utf8_decode($_GET["dente5"]);
	}else {if (isset($_POST["dente5"])){
  		$dente5 = utf8_decode($_POST["dente5"]);
	}};
	
	if (isset($_GET["valor5"])){
  		$valor5 = utf8_decode($_GET["valor5"]);
	}else {if (isset($_POST["valor5"])){
  		$valor5 = utf8_decode($_POST["valor5"]);
	}};
    
    if (isset($_GET["codconvenio6"])){
        $codconvenio6 = utf8_decode($_GET["codconvenio6"]);
    }else {if (isset($_POST["codconvenio6"])){
        $codconvenio6 = utf8_decode($_POST["codconvenio6"]);
    }};
    
    if (isset($_GET["proc6"])){
        $proc6 = utf8_decode($_GET["proc6"]);
    }else {if (isset($_POST["proc6"])){
        $proc6 = utf8_decode($_POST["proc6"]);
    }};
    
    if (isset($_GET["dente6"])){
        $dente6 = utf8_decode($_GET["dente6"]);
    }else {if (isset($_POST["dente6"])){
        $dente6 = utf8_decode($_POST["dente6"]);
    }};
    
    if (isset($_GET["valor6"])){
        $valor6 = utf8_decode($_GET["valor6"]);
    }else {if (isset($_POST["valor6"])){
        $valor6 = utf8_decode($_POST["valor6"]);
    }};
    
    if (isset($_GET["codconvenio7"])){
        $codconvenio7 = utf8_decode($_GET["codconvenio7"]);
    }else {if (isset($_POST["codconvenio7"])){
        $codconvenio7 = utf8_decode($_POST["codconvenio7"]);
    }};
    
    if (isset($_GET["proc7"])){
        $proc7 = utf8_decode($_GET["proc7"]);
    }else {if (isset($_POST["proc7"])){
        $proc7 = utf8_decode($_POST["proc7"]);
    }};
    
    if (isset($_GET["dente7"])){
        $dente7 = utf8_decode($_GET["dente7"]);
    }else {if (isset($_POST["dente7"])){
        $dente7 = utf8_decode($_POST["dente7"]);
    }};
    
    if (isset($_GET["valor7"])){
        $valor7 = utf8_decode($_GET["valor7"]);
    }else {if (isset($_POST["valor7"])){
        $valor7 = utf8_decode($_POST["valor7"]);
    }};
    
    if (isset($_GET["codconvenio8"])){
        $codconvenio8 = utf8_decode($_GET["codconvenio8"]);
    }else {if (isset($_POST["codconvenio8"])){
        $codconvenio8 = utf8_decode($_POST["codconvenio8"]);
    }};
    
    if (isset($_GET["proc8"])){
        $proc8 = utf8_decode($_GET["proc8"]);
    }else {if (isset($_POST["proc8"])){
        $proc8 = utf8_decode($_POST["proc8"]);
    }};
    
    if (isset($_GET["dente8"])){
        $dente8 = utf8_decode($_GET["dente8"]);
    }else {if (isset($_POST["dente8"])){
        $dente8 = utf8_decode($_POST["dente8"]);
    }};
    
    if (isset($_GET["valor8"])){
        $valor8 = utf8_decode($_GET["valor8"]);
    }else {if (isset($_POST["valor8"])){
        $valor8 = utf8_decode($_POST["valor8"]);
    }};
    
    if (isset($_GET["codconvenio9"])){
        $codconvenio9 = utf8_decode($_GET["codconvenio9"]);
    }else {if (isset($_POST["codconvenio9"])){
        $codconvenio9 = utf8_decode($_POST["codconvenio9"]);
    }};
    
    if (isset($_GET["proc9"])){
        $proc9 = utf8_decode($_GET["proc9"]);
    }else {if (isset($_POST["proc9"])){
        $proc9 = utf8_decode($_POST["proc9"]);
    }};
    
    if (isset($_GET["dente9"])){
        $dente9 = utf8_decode($_GET["dente9"]);
    }else {if (isset($_POST["dente9"])){
        $dente9 = utf8_decode($_POST["dente9"]);
    }};
    
    if (isset($_GET["valor9"])){
        $valor9 = utf8_decode($_GET["valor9"]);
    }else {if (isset($_POST["valor9"])){
        $valor9 = utf8_decode($_POST["valor9"]);
    }};
    
    if (isset($_GET["codconvenio10"])){
        $codconvenio10 = utf8_decode($_GET["codconvenio10"]);
    }else {if (isset($_POST["codconvenio10"])){
        $codconvenio10 = utf8_decode($_POST["codconvenio10"]);
    }};
    
    if (isset($_GET["proc10"])){
        $proc10 = utf8_decode($_GET["proc10"]);
    }else {if (isset($_POST["proc10"])){
        $proc10 = utf8_decode($_POST["proc10"]);
    }};
    
    if (isset($_GET["dente10"])){
        $dente10 = utf8_decode($_GET["dente10"]);
    }else {if (isset($_POST["dente10"])){
        $dente10 = utf8_decode($_POST["dente10"]);
    }};
    
    if (isset($_GET["valor10"])){
        $valor10 = utf8_decode($_GET["valor10"]);
    }else {if (isset($_POST["valor10"])){
        $valor10 = utf8_decode($_POST["valor10"]);
    }};
    
    if (isset($_GET["obs"])){
        $obs = $_GET["obs"];
    }else {if (isset($_POST["obs"])){
        $obs = $_POST["obs"];
    }};
    
    if (isset($_GET["desconto"])){
    	$desconto = $_GET["desconto"];
    }else {if (isset($_POST["desconto"])){
    	$desconto = $_POST["desconto"];
    }};
    
    //Verifica se o valor do desconto está vazio
    if (empty($desconto))
    {
    	$desconto = 0;
    }
	
	$sql = "SELECT data, matricula, cpf, endereco, bairro, cep, telefone, celular, nome, id FROM pacientes WHERE codigo = '$codigo';";
	$resultado = mysql_query($sql);
	$result = mysql_fetch_array($resultado);
	
	$sqlp = "SELECT nome, crmcro FROM profissionais WHERE id = '$profissional';";
	$resultadop = mysql_query($sqlp);
	$resultp = mysql_fetch_array($resultadop);
    
    $sqlcon = "SELECT nome FROM convenios WHERE id = '$convenio';";
    $resultadocon = mysql_query($sqlcon);
    $resultcon = mysql_fetch_array($resultadocon);
	
	$datan = implode("/", array_reverse(explode("-", $result[0])));
	
	$data2 = $dia1."/".$mes1."/".$ano1;
	
	//Data no formato do banco de dados
	$datac = implode("-", array_reverse(explode("/", $data2)));
	
	// Separa em dia, m�s e ano
    list($dia, $mes, $ano) = explode('/', $datan);
    
    // Descobre que dia � hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    
    // Depois apenas fazemos o c�lculo j� citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
    
	//Converte para o formato para ser calculado o valor pelo sistema
	$v1 = str_replace(".","",$valor);
	$v1 = str_replace(",",".",$v1);
	//Converte para o formato para ser calculado o valor pelo sistema
	$v2 = str_replace(".","",$valor2);
	$v2 = str_replace(",",".",$v2);
	//Converte para o formato para ser calculado o valor pelo sistema
	$v3 = str_replace(".","",$valor3);
	$v3 = str_replace(",",".",$v3);
	//Converte para o formato para ser calculado o valor pelo sistema
	$v4 = str_replace(".","",$valor4);
	$v4 = str_replace(",",".",$v4);
	//Converte para o formato para ser calculado o valor pelo sistema
	$v5 = str_replace(".","",$valor5);
	$v5 = str_replace(",",".",$v5);
    //Converte para o formato para ser calculado o valor pelo sistema
    $v6 = str_replace(".","",$valor6);
    $v6 = str_replace(",",".",$v6);
    //Converte para o formato para ser calculado o valor pelo sistema
    $v7 = str_replace(".","",$valor7);
    $v7 = str_replace(",",".",$v7);
    //Converte para o formato para ser calculado o valor pelo sistema
    $v8 = str_replace(".","",$valor8);
    $v8 = str_replace(",",".",$v8);
    //Converte para o formato para ser calculado o valor pelo sistema
    $v9 = str_replace(".","",$valor9);
    $v9 = str_replace(",",".",$v9);
    //Converte para o formato para ser calculado o valor pelo sistema
    $v10 = str_replace(".","",$valor10);
    $v10 = str_replace(",",".",$v10);
	
	$auxcod = array("$codconvenio","$codconvenio2", "$codconvenio3", "$codconvenio4", "$codconvenio5", "$codconvenio6","$codconvenio7", "$codconvenio8", "$codconvenio9", "$codconvenio10");
	reset($auxcod);
	foreach ($auxcod as $cod) {
		if (!empty($cod)){
			//Salva as informa��es na tabela procodont para gerar os relat�rios
			$sqli = "INSERT INTO procodont (nomepaciente, procedimento, profissional, convenio, data) VALUES ('$result[9]', '$cod', '$profissional', '$convenio', '$datac');";
			// Executa o comando SQL
			mysql_query($sqli);
		}
	}
	
	//Instanciação da classe herdada
    $pdf=new PDF("L","mm","A4"); //P->Retrato, L->Paisagem; mm-> milímetros; A4-> padrão da folha
    //$pdf = new MEM_IMAGE;
    $pdf->AliasNbPages(); //Recebe o total de páginas
    $pdf->AddPage(); //Coloca uma página em branco
    $pdf->Line(148,0,148,210); //Adiciona a linha no centro da pagina
    
                    //BLOCO DO NOME GUIA DE PROCEDIMENTOS
    //-----------------------------------------------------------------------------------------------
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(33);
    $pdf->Cell(70,10,utf8_decode('Guia de Procedimentos'),0,0,'C');
    $pdf->SetX(180);
    $pdf->Cell(70,10,utf8_decode('Guia de Procedimentos'),0,0,'C');
    //-----------------------------------------------------------------------------------------------
                    
                    //BLOCO DA LINHA
    //-----------------------------------------------------------------------------------------------
    $pdf->SetFont('Arial','U',8);
    $pdf->Ln(7);
    $pdf->Cell(50,10,'                                                                                                                                                                            ',0,0);
    $pdf->SetX(149);
    $pdf->Cell(50,10,'                                                                                                                                                                            ',0,0);
    $pdf->Ln(7);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DA PRIMEIRA LINHA
    //-----------------------------------------------------------------------------------------------    
    $pdf->SetFont('Arial','U',8);
    $pdf->Cell(1);
    $pdf->Cell(50,10,'Nome: '.$result[8],0,0);
    $pdf->Cell(50);
    $pdf->Cell(50,10,'Data de Nasc.: '.$datan,0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(50,10,'Nome: '.$result[8],0,0);
    $pdf->Cell(50);
    $pdf->Cell(50,10,'Data de Nasc.: '.$datan,0,0);
    $pdf->Ln(7);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DA SEGUNDA LINHA
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(1);
    $pdf->Cell(45,10,utf8_decode('Convênio: ').$resultcon[0],0,0);
    $pdf->Cell(20);
    $pdf->Cell(40,10,utf8_decode('Matricula: ').$result[1],0,0);
    $pdf->Cell(1);
    $pdf->Cell(50,10,utf8_decode('CPF: ').$result[2],0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(45,10,utf8_decode('Convênio: ').$resultcon[0],0,0);
    $pdf->Cell(20);
    $pdf->Cell(40,10,utf8_decode('Matricula: ').$result[1],0,0);
    $pdf->Cell(1);
    $pdf->Cell(50,10,utf8_decode('CPF: ').$result[2],0,0);
    $pdf->Ln(7);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DA TERCEIRA LINHA
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(1);
    $pdf->Cell(70,10,utf8_decode('Endereço: ').$result[3],0,0);
    $pdf->SetX(149);
    $pdf->Cell(70,10,utf8_decode('Endereço: ').$result[3],0,0);
    $pdf->Ln(7);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DA QUARTA LINHA
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(1);
    $pdf->Cell(30,10,utf8_decode('CEP: ').$result[5],0,0);
    $pdf->Cell(10);
    $pdf->Cell(50,10,utf8_decode('Bairro: ').$result[4],0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(30,10,utf8_decode('CEP: ').$result[5],0,0);
    $pdf->Cell(10);
    $pdf->Cell(50,10,utf8_decode('Bairro: ').$result[4],0,0);
    $pdf->Ln(7);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DA QUINTA LINHA
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(1);
    $pdf->Cell(30,10,utf8_decode('Telefone: ').$result[6],0,0);
    $pdf->Cell(30);
    $pdf->Cell(50,10,utf8_decode('Celular: ').$result[7],0,0);
    $pdf->Cell(5);
    $pdf->Cell(50,10,utf8_decode('Idade: ').$idade,0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(30,10,utf8_decode('Telefone: ').$result[6],0,0);
    $pdf->Cell(30);
    $pdf->Cell(50,10,utf8_decode('Celular: ').$result[7],0,0);
    $pdf->Cell(5);
    $pdf->Cell(50,10,utf8_decode('Idade: ').$idade,0,0);
    $pdf->Ln(7);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DA SEXTA LINHA
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(1);
    $pdf->Cell(50,10,utf8_decode('Profissional: ').$resultp[0],0,0);
    $pdf->Cell(65);
    $pdf->Cell(50,10,utf8_decode('CRO: ').$resultp[1],0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(50,10,utf8_decode('Profissional: ').$resultp[0],0,0);
    $pdf->Cell(65);
    $pdf->Cell(50,10,utf8_decode('CRO: ').$resultp[1],0,0);
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DA LINHA
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(50,10,'                                                                                                                                                                            ',0,0);
    $pdf->SetX(149);
    $pdf->Cell(50,10,'                                                                                                                                                                            ',0,0);
    $pdf->Ln(5);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DE SERVICOS
    //-----------------------------------------------------------------------------------------------
    $pdf->SetFont('Arial','BIU',10);
    $pdf->Cell(57);
    $pdf->Cell(0,10,utf8_decode('Serviços'),0,0);
    $pdf->SetX(149);
    $pdf->Cell(57);
    $pdf->Cell(0,10,utf8_decode('Serviços'),0,0);
    $pdf->Ln(5);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DE CATEGORIAS
    //-----------------------------------------------------------------------------------------------
    $pdf->SetFont('Arial','U',8);
    $pdf->Cell(1);
    $pdf->Cell(7,10,utf8_decode('Código'),0,0);
    $pdf->Cell(7);
    $pdf->Cell(45,10,'Procedimento',0,0);
    $pdf->Cell(40);
    $pdf->Cell(10,10,'Dente',0,0);
    $pdf->Cell(7);
    $pdf->Cell(16,10,'Valor',0,0);
    $pdf->SetX(149);
    $pdf->Cell(1);
    $pdf->Cell(7,10,utf8_decode('Código'),0,0);
    $pdf->Cell(7);
    $pdf->Cell(45,10,'Procedimento',0,0);
    $pdf->Cell(40);
    $pdf->Cell(10,10,'Dente',0,0);
    $pdf->Cell(7);
    $pdf->Cell(16,10,'Valor',0,0);
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 1
    //-----------------------------------------------------------------------------------------------
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("96");
    //posiciona horizontalmente
    $pdf->SetX("25");
    $pdf->MultiCell(85,5,$proc,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("94");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("94");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio)) {
        $pdf->Cell(10,10,$valor,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("96");
    //posiciona horizontalmente
    $pdf->SetX("164");
    $pdf->MultiCell(85,5,$proc,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("94");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("94");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio)) {
        $pdf->Cell(10,10,$valor,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 2
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio2,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("100");
    //posiciona horizontalmente
    $pdf->SetX("25");
    $pdf->MultiCell(85,5,$proc2,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("98");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente2,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("98");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio2)) {
        $pdf->Cell(10,10,$valor2,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor2,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio2,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("100");
    //posiciona horizontalmente
    $pdf->SetX("164");
    $pdf->MultiCell(85,5,$proc2,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("98");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente2,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("98");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio2)) {
        $pdf->Cell(10,10,$valor2,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor2,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 3
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio3,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("104");
    //posiciona horizontalmente
    $pdf->SetX("25" );
    $pdf->MultiCell(85,5,$proc3,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("102");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente3,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("102");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio3)) {
        $pdf->Cell(10,10,$valor3,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor3,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio3,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("104");
    //posiciona horizontalmente
    $pdf->SetX("164" );
    $pdf->MultiCell(85,5,$proc3,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("102");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente3,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("102");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio3)) {
        $pdf->Cell(10,10,$valor3,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor3,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 4
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio4,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("108");
    //posiciona horizontalmente
    $pdf->SetX("25" );
    $pdf->MultiCell(85,5,$proc4,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("106");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente4,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("106");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio4)) {
        $pdf->Cell(10,10,$valor4,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor4,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio4,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("108");
    //posiciona horizontalmente
    $pdf->SetX("164" );
    $pdf->MultiCell(85,5,$proc4,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("106");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente4,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("106");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio4)) {
        $pdf->Cell(10,10,$valor4,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor4,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 5
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio5,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("112");
    //posiciona horizontalmente
    $pdf->SetX("25" );
    $pdf->MultiCell(85,5,$proc5,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("110");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente5,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("110");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio5)) {
        $pdf->Cell(10,10,$valor5,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor5,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio5,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("112");
    //posiciona horizontalmente
    $pdf->SetX("164" );
    $pdf->MultiCell(85,5,$proc5,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("110");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente5,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("110");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio5)) {
        $pdf->Cell(10,10,$valor5,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor5,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 6
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio6,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("116");
    //posiciona horizontalmente
    $pdf->SetX("25" );
    $pdf->MultiCell(85,5,$proc6,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("114");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente6,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("114");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio6)) {
        $pdf->Cell(10,10,$valor6,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor6,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio6,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("116");
    //posiciona horizontalmente
    $pdf->SetX("164" );
    $pdf->MultiCell(85,5,$proc6,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("114");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente6,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("114");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio6)) {
        $pdf->Cell(10,10,$valor6,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor6,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 7
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio7,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("120");
    //posiciona horizontalmente
    $pdf->SetX("25" );
    $pdf->MultiCell(85,5,$proc7,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("118");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente7,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("118");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio7)) {
        $pdf->Cell(10,10,$valor7,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor7,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio7,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("120");
    //posiciona horizontalmente
    $pdf->SetX("164" );
    $pdf->MultiCell(85,5,$proc7,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("118");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente7,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("118");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio7)) {
        $pdf->Cell(10,10,$valor7,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor7,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 8
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio8,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("124");
    //posiciona horizontalmente
    $pdf->SetX("25" );
    $pdf->MultiCell(85,5,$proc8,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("122");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente8,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("122");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio8)) {
        $pdf->Cell(10,10,$valor8,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor8,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio8,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("124");
    //posiciona horizontalmente
    $pdf->SetX("164" );
    $pdf->MultiCell(85,5,$proc8,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("122");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente8,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("122");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio8)) {
        $pdf->Cell(10,10,$valor8,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor8,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 9
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio9,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("128");
    //posiciona horizontalmente
    $pdf->SetX("25" );
    $pdf->MultiCell(85,5,$proc9,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("126");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente9,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("126");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio9)) {
        $pdf->Cell(10,10,$valor9,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor9,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio9,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("128");
    //posiciona horizontalmente
    $pdf->SetX("164" );
    $pdf->MultiCell(85,5,$proc9,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("126");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente9,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("126");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio9)) {
        $pdf->Cell(10,10,$valor9,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor9,0,0);
    }
    $pdf->Ln(4);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DENTE 10
    //-----------------------------------------------------------------------------------------------
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio10,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("132");
    //posiciona horizontalmente
    $pdf->SetX("25" );
    $pdf->MultiCell(85,5,$proc10,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("130");
    //posiciona horizontalmente
    $pdf->SetX("112");
    $pdf->Cell(10,10,$dente10,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("130");
    //posiciona horizontalmente
    $pdf->SetX("123");
    if (empty($codconvenio10)) {
        $pdf->Cell(10,10,$valor10,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor10,0,0);
    }
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(7,10,$codconvenio10,0,0);
    $pdf->Cell(4);
    //posiciona verticalmente
    $pdf->SetY("132");
    //posiciona horizontalmente
    $pdf->SetX("164" );
    $pdf->MultiCell(85,5,$proc10,0);
    //$pdf->Cell(80);
    //posiciona verticalmente
    $pdf->SetY("130");
    //posiciona horizontalmente
    $pdf->SetX("251");
    $pdf->Cell(10,10,$dente10,0,0);
    $pdf->Cell(6);
    //posiciona verticalmente
    $pdf->SetY("130");
    //posiciona horizontalmente
    $pdf->SetX("262");
    if (empty($codconvenio10)) {
        $pdf->Cell(10,10,$valor10,0,0);
    } else {
        $pdf->Cell(10,10,'R$'.$valor10,0,0);
    }
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO CALCULO DO VALOR TOTAL
    //-----------------------------------------------------------------------------------------------
    $acu = (((float) $v1 + (float) $v2 + (float) $v3 + (float) $v4 + (float) $v5 + (float) $v6 + (float) $v7 + (float) $v8 + (float) $v9 + (float) $v10) - (float) $desconto);	    
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(1);
	$pdf->Cell(10,10,'Desconto: R$ '.number_format($desconto,2,',','.'),0,0);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(84);
	$pdf->Cell(10,10,'Total: R$ '.number_format($acu,2,',','.'),0,0);
	$pdf->SetX("151");
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10,10,'Desconto: R$ '.number_format($desconto,2,',','.'),0,0);
    $pdf->SetX("245");
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,10,'Total: R$ '.number_format($acu,2,',','.'),0,0);
	$pdf->Ln(10);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO DE OBSERVACAO
    //-----------------------------------------------------------------------------------------------
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(3);
    $pdf->Cell(125,3,'Obs: '.utf8_decode($obs),1,0);
    $pdf->SetX(149);
    $pdf->Cell(3);
    $pdf->Cell(125,3,'Obs: '.utf8_decode($obs),1,0);
    $pdf->Ln(7);
    //-----------------------------------------------------------------------------------------------
    
	                //BLOCO DIA, MES E ANO
    //-----------------------------------------------------------------------------------------------
	$pdf->Cell(50);
	$pdf->Cell(0,10,utf8_decode($dia1. ' de '.$mes2. ' de '.$ano1),0,0);
    $pdf->SetX(149);
    $pdf->Cell(50);
    $pdf->Cell(0,10,utf8_decode($dia1. ' de '.$mes2. ' de '.$ano1),0,0);
    //-----------------------------------------------------------------------------------------------
    
	                //BLOCO ASSINATURA
    //-----------------------------------------------------------------------------------------------
	$pdf->Ln(8);
	$pdf->SetFont('Arial','U',10);
    $pdf->Cell(17);
	$pdf->Cell(0,10,utf8_decode('                                                                                                       '),0,0);
    $pdf->SetX(149);
    $pdf->Cell(17);
    $pdf->Cell(0,10,utf8_decode('                                                                                                       '),0,0);
	$pdf->Ln(7);    
	$pdf->SetFont('Arial','',8);
    $pdf->Cell(43);
	$pdf->Cell(0,10,utf8_decode($buscanome),0,0);
    $pdf->SetX(149);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(43);
    $pdf->Cell(0,10,utf8_decode($buscanome),0,0);
	$pdf->Ln(10);
    //-----------------------------------------------------------------------------------------------
    
                    //BLOCO RODAPE
    //-----------------------------------------------------------------------------------------------
	$pdf->Cell(20);
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(0,10,utf8_decode('Procedimentos já autorizados pelo departamento responsável do convênio acima citado.'),0,0);
    $pdf->SetX(149);
    $pdf->Cell(20);
    $pdf->Cell(0,10,utf8_decode('Procedimentos já autorizados pelo departamento responsável do convênio acima citado.'),0,0);
    //-----------------------------------------------------------------------------------------------
    
	$pdf->Output("guiadeprocedimentos".$buscanome.".pdf",D); //Gera o pdf e permite o download

?>
