<?
# Arquivo de verificacao de login e senha

//Requer conexao previa com o banco
require_once ("configs/conn.php");

// Obtem os dados do formulario de login
session_start();
$login = $_POST["user"]; //Recebe o login
$senha = $_POST["pass"]; //Recebe a senha

// trata os dados recebidos;
$login = str_replace(" ", "",$login);
$login = str_replace("/","",$login);
$login = str_replace(";","",$login);
$senha = str_replace(" ", "",$senha);
$senha = str_replace("/","",$senha);
$senha = str_replace(";","",$senha);

// Busca no banco de dados o usuario informado
//$resultado = mysql_query("SELECT login, senha, perfil, nome FROM users WHERE login = '$login' AND senha = ENCRYPT('" .$senha. "', senha);");
$resultado = mysql_query("SELECT login, senha, perfil FROM users WHERE login = '$login' AND senha = ENCRYPT('" .$senha. "', senha);");
$linhas = mysql_num_rows($resultado);

if ($linhas > 0){ //Verifica se encontrou algum usuário

  $_SESSION['autenticado']="sim";
  $_SESSION['login']=mysql_result($resultado,0,"login");
  $_SESSION['perfil']= mysql_result($resultado,0,"perfil");
  //$_SESSION['nome']= mysql_result($resultado,0,"nome");
  header ("location:inicio.php");
}
else {

	?>
	<!-- INCLUI O INICIO DO ARQUIVO -->
	<!DOCTYPE html>
	<html>
	<head>
	    <link rel="shortcut icon" type="image/x-icon" href="imagens/icone.ico"/> <!-- ICONE DA PAGINA -->
	    <script src="js/jquery.min.js"></script>        <!-- SCRIPT BASE -->
	    <script src="js/jquery.widget.min.js"></script> <!-- SCRIPT BASE -->
	    <script src="js/jquery.mousewheel.js"></script> <!-- SCRIPT BASE -->
	    <script src="js/metro.min.js"></script>         <!-- SCRIPT BASE -->
	    <script src="js/load-metro.js"></script>        <!-- SCRIPT BASE -->
	    <script src="js/prettify/prettify.js"></script> <!-- SCRIPT BASE -->
	    <script src="js/load-metro.js"></script>        <!-- Metro UI CSS JavaScript plugins -->
	    <link href="css/metro-bootstrap.css" rel="stylesheet">            <!-- CSS BASE -->
	    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet"> <!-- CSS BASE -->
	    <link href="css/iconFont.css" rel="stylesheet">                   <!-- CSS BASE -->
	    <meta charset="UTF-8"> <!-- CODIFICACAO -->
	</head>
	
	<!-- INICIO DO ARQUIVO -->
	<body class="metro">
	    
	    <br>
	
	    <img src="imagens/photo1.jpg" />
	    
	    <center><img src="imagens/principal1.png" /></center>
	    <br><br>
	    
	    <div class="grid">
	        <div class="row">
	    
	            <div class="span5"></div>
	            <div class="span10">
	                <div class="">
	                    <div class="panel">
	                        <div class="panel-header bg-lightRed fg-white">
	                            <center>Login Incorreto!!!</center>
	                        </div>
	                        <div class="panel-content">
	                            <center>Usuário/Senha incorretos....</center> 
	                        </div>
	                    </div><br />
	                    <center>
	                        <a class="button bg-darkRed fg-white" href="index.php"><i class="icon-locked on-left" style="top: -3px; left: 7px"></i>Login</a>
	                    </center>
	                </div>
	            </div>
	            <br>
	            
	        </div>
	    </div>
	
	</body>
	<!-- FIM DO ARQUIVO -->
	
	<!-- INCLUI O FIM DO ARQUIVO -->
	<? include ("footer.php"); ?>
<?
}
?>
