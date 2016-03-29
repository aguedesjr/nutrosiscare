<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<script src="js/cep.js" type="text/javascript"></script> <!-- SCRIPT CEP -->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->

    <script>
                
        //function zerar() {
          //  document.getElementById("divcpf").className = "input-control text";
          //  document.getElementById("divnome").className = "input-control text";
          //  document.getElementById("salvapaciente").reset();
            
        //}
        
        function valida(form) {
            if (form.codigo.value=="") {
                alert("Codigo não informado!!");
                document.getElementById("divcodigo").className = "input-control text size2 error-state";
                form.codigo.focus();
                return false;
            }
            
            if (form.codigo.value!="") {
                document.getElementById("divcodigo").className = "input-control text size2";
            }
        };
        
    </script>
    
    <script>
        $(function() {
            
            //jQuery(function($){
                //$("#cpf").mask("999.999.999-99");
            //});
            
            var total = 0;
            var aux = []; //Variavel de auxilio para o calculo do valor final
            
            $('#codigo').change(function(){
                if( $(this).val() ) {                   
                    $.getJSON('getnome.php?search=',{codigo: $(this).val(), ajax: 'true'}, function(j){ 
                        for (var i = 0; i < j.length; i++) {
                            $("input[name='nome']").val(j[i].nome);
                        }
                    });
                }
            });
            
            $("#datepicker").datepicker({
                //date: "2013-01-01", // set init date
                format: "dd/mm/yyyy", // set output format
                effect: "slide", // none, slide, fade
                position: "bottom", // top or bottom,
                locale: 'pt', // 'ru' or 'en', default is $.Metro.currentLocale (metro-locale.js)
            });
        });
    </script>
    
<?
//Recebe as informacoes buscadas na busca de pacientes

if (isset($_GET["codigo"])){
	$codigo = utf8_decode($_GET["codigo"]);
}else {if (isset($_POST["codigo"])){
	$codigo = utf8_decode($_POST["codigo"]);
}};

// Busca informações do paciente
$sqlpac = "SELECT nome, id, convenio FROM pacientes WHERE codigo = '$codigo'";
$resultadopac = mysql_query($sqlpac);
$resultpac = mysql_fetch_array($resultadopac);

// Busca informações da ficha do paciente
$sqlficha = "SELECT data, pesoatual, altura, imc, ca, pesousual, pa, med, queixa, histopato, medreg, alergiamed, qualalergiamed,
			 habint, ativfis, qualativfis, coltotal, hdl, ldl, vldl, ht, hb FROM receituario WHERE codigo = '$codigo'";
$resultadoficha = mysql_query($sqlficha);
$resultficha = mysql_fetch_array($resultadoficha);

// Data para ser exibida
$datan = implode("/", array_reverse(explode("-", $resultficha[0])));


?>

<!-- INICIO DO ARQUIVO -->
<body class="metro">
    
    <br>

    <img src="imagens/photo1.jpg" />
    <br><br><br>
    
    <center><img src="imagens/principal1.png" /></center>
    <br><br>
    
    <div class="grid">
        <div class="row">
    
            <? include ("menu.php"); ?>
            <div class="span1"></div>
            <div class="span10">
                <form method="POST" onsubmit="return valida(this);" action="salvareceituario.php" name="salvareceituario" id="salvareceituario">
                <div class="receituario">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                        <li class=""><a href="#_page_2">Informações</a></li>
                        <li class=""><a href="#_page_3">Exames</a></li>
                        <li class=""><a href="#_page_4">Dieta Usual</a></li>
                        <li class=""><a href="#_page_5">Dieta</a></li>
                        <li class=""><a href="#_page_6">Conduta</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Codigo</label>
                            <table><tr>
                                 <td bgcolor="#FDFDFD">
                            <div class="input-control text size2" id="divcodigo" data-role="input-control">
                                <input type="text" id="codigo" name="codigo" placeholder="Codigo do Paciente" value="<? echo $codigo?>">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <!-- <td bgcolor="#FDFDFD">
                                    <a class="button image-button primary image-left" name="buscarPaciente" href="buscarpacientereceituario.php"><i class="icon-search on-left" style="top: -3px; left: 7px"></i>Buscar</a>
                                </td>  --> 
                            </tr></table>
                            <label>Nome</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" id="nome" name="nome" readonly="readonly" value="<? echo utf8_encode($resultpac[0])?>" placeholder="Nome do Paciente">
                                <input type="hidden" id="id" name="id" value="<? echo $resultpac[1];?>"> <!-- Envia o id do paciente -->
                                <input type="hidden" id="opbd" name="opbd" value="cadastrar"> <!-- Envia qual ação o BD irá realizar -->
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Convênio</label>
                                <div class="input-control text size3" data-role="input-control">
	                                <input type="text" readonly="readonly" value="<? echo utf8_encode($resultpac[2]);?>" id="convenio" name="convenio" placeholder="Convênio">
	                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Data</label>
                                    <div class="input-control text" id="datepicker">
                                        <input type="text" name="data" value="<? echo $datan; ?>" placeholder="Data">
                                        <button class="btn-date"></button>
                                    </div>
                                </td>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Peso Atual</label>
                                <div class="input-control text size2" data-role="input-control">
	                                <input type="text" id="pesoatual" name="pesoatual" value="<? echo $resultficha[1]; ?>" placeholder="Peso Atual">
	                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Altura</label>
                                    <div class="input-control text size2" data-role="input-control">
                                        <input type="text" name="altura" value="<? echo $resultficha[2]; ?>" placeholder="Altura">
                                    </div>
                                </td>
                                <br /></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                <label>IMC</label>
                                <div class="input-control text size2" data-role="input-control">
	                                <input type="text" id="imc" name="imc" value="<? echo $resultficha[3]; ?>" placeholder="IMC">
	                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>CA</label>
                                <div class="input-control text size2" data-role="input-control">
	                                <input type="text" id="ca" name="ca" value="<? echo $resultficha[4]; ?>" placeholder="CA">
	                            </div>
                            <br></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Peso Usual</label>
                                <div class="input-control text size2" data-role="input-control">
	                                <input type="text" id="pesousual" name="pesousual" value="<? echo $resultficha[5]; ?>" placeholder="Peso Usual">
	                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>PA</label>
                                    <div class="input-control text size2" data-role="input-control">
                                        <input type="text" name="pa" value="<? echo $resultficha[6]; ?>" placeholder="PA">
                                    </div>
                                </td>
                                <br /></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            
							<br>
                            
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Salvar
                                    <i class="icon-floppy on-left" style="top: -3px; left: 7px">
                                    </i>
                                </button>
                                <!--<button type="button" onclick="zerar();" class="image-button danger image-left">
                                    Limpar
                                    <i class="icon-spin on-left" style="top: -2px; left: 7px">
                                    </i>
                                </button>-->
                                
                            </center>
                        </div>
                        
                        <div class="frame" id="_page_2">
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Médico Assitente</label>
                                <div class="input-control text size6" data-role="input-control">
                                <input type="text" id="med" name="med" value="<? echo $resultficha[7]; ?>" placeholder="Médico Assitente">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <label>Queixa Principal</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="queixa" placeholder="Queixa Principal"><? echo utf8_encode($resultficha[8]); ?></textarea>
                            </div>
                            
                            <label>História Patológica Pregressa</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="histopato" placeholder="História Patológica Pregressa"><? echo utf8_encode($resultficha[9]); ?></textarea>
                            </div>
                            
                            <label>Medicamentos Regulares</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="medreg" placeholder="Medicamentos Regulares"><? echo utf8_encode($resultficha[10]); ?></textarea>
                            </div>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Alergia Medicamentosa</label>
                                <div class="input-control select">
	                                <select name="alergiamed">
	                                	<option value="<? echo utf8_encode($resultficha[11]); ?>"><? echo utf8_encode($resultficha[11]) ;?></option>
	                                	<option value="">---------</option>
	                                	<option value="SIM">SIM</option>
	                                	<option value="NÃO">NÃO</option>
	                                </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Qual</label>
                                    <div class="input-control text size4" data-role="input-control">
                                        <input type="text" value="<? echo utf8_encode($resultficha[12]); ?>" name="qualalergiamed" placeholder="Qual">
                                    </div>
                                </td>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Hábitos Intestinais</label>
                                <div class="input-control select">
	                                <select name="habint">
	                                	<option value="<? echo utf8_encode($resultficha[13]); ?>"><? echo utf8_encode($resultficha[13]) ;?></option>
	                                	<option value="">---------</option>
	                                	<option value="NORMAL">NORMAL</option>
	                                	<option value="CONSTIPADO">CONSTIPADO</option>
	                                	<option value="DIARRÉIA">DIARRÉIA</option>
	                                </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            
                            <td bgcolor="#FDFDFD">
                                <label>Atividade Física</label>
                                <div class="input-control select">
	                                <select name="ativfis">
	                                	<option value="<? echo utf8_encode($resultficha[14]); ?>"><? echo utf8_encode($resultficha[14]) ;?></option>
	                                	<option value="">---------</option>
	                                	<option value="SIM">SIM</option>
	                                	<option value="NÃO">NÃO</option>
	                                </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Qual</label>
                                    <div class="input-control text size4" data-role="input-control">
                                        <input type="text" value="<? echo utf8_encode($resultficha[15]); ?>" name="qualativfis" placeholder="Qual">
                                    </div>
                                </td>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
							<br>
                            
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Salvar
                                    <i class="icon-floppy on-left" style="top: -3px; left: 7px">
                                    </i>
                                </button>
                                <!--<button type="button" onclick="zerar();" class="image-button danger image-left">
                                    Limpar
                                    <i class="icon-spin on-left" style="top: -2px; left: 7px">
                                    </i>
                                </button>-->
                                
                            </center>
                        </div>
                        
                        <div class="frame" id="_page_3">
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Colesterol Total</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="coltotal" name="coltotal" value="<? echo utf8_encode($resultficha[16]); ?>" placeholder="Colesterol Total">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>HDL</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="hdl" name="hdl" value="<? echo utf8_encode($resultficha[17]); ?>" placeholder="HDL">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>LDL</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="ldl" name="ldl" value="<? echo utf8_encode($resultficha[18]); ?>" placeholder="LDL">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>VLDL</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="vldl" name="vldl" value="<? echo utf8_encode($resultficha[19]); ?>" placeholder="VLDL">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>HT</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="ht" name="ht" value="<? echo utf8_encode($resultficha[20]); ?>" placeholder="HT">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>HB</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="hb" name="hb" value="<? echo utf8_encode($resultficha[21]); ?>" placeholder="HB">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Glicose</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="glicose" name="glicose" placeholder="Glicose">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>HB Glicosada</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="hbglicosada" name="hbglicosada" placeholder="HB Glicosada">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>VCM</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="vcm" name="vcm" placeholder="VCM">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Uréia</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="ureia" name="ureia" placeholder="Uréia">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>TGO</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="tgo" name="tgo" placeholder="TGO">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>TGP</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="tgp" name="tgp" placeholder="TGP">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>CPK</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="cpk" name="cpk" placeholder="CPK">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Sódio</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="sodio" name="sodio" placeholder="Sódio">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Potássio</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="potassio" name="potassio" placeholder="Potássio">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Cálcio</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="calcio" name="calcio" placeholder="Cálcio">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Vitamina D</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="vitaminad" name="vitaminad" placeholder="Vitamina D">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Vitamina B12</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="vitaminab12" name="vitaminab12" placeholder="Vitamina B12">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Ácido Fólico</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="acidofolico" name="acidofolico" placeholder="Ácido Fólico">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>PTNC</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="ptnc" name="ptnc" placeholder="PTNC">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>VHS</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="vhs" name="vhs" placeholder="VHS">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Insulina</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="insulina" name="insulina" placeholder="Insulina">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>PTN Total</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="ptntotal" name="ptntotal" placeholder="PTN Total">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>TTOG</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="ttog" name="ttog" placeholder="TTOG">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Albumina</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="albumina" name="albumina" placeholder="Albumina">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Globulina</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="globulina" name="globulina" placeholder="Globulina">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
							<br>
                            
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Salvar
                                    <i class="icon-floppy on-left" style="top: -3px; left: 7px">
                                    </i>
                                </button>
                                <!--<button type="button" onclick="zerar();" class="image-button danger image-left">
                                    Limpar
                                    <i class="icon-spin on-left" style="top: -2px; left: 7px">
                                    </i>
                                </button>-->
                                
                            </center>
                        </div>
                        
                        <div class="frame" id="_page_4">
                            <label>Café da Manhã</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="cafeusual" placeholder="Café da Manhã"></textarea>
                            </div>
                            
                            <label>Colação</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="colacaousual" placeholder="Colação"></textarea>
                            </div>
                            
                            <label>Almoço</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="almocousual" placeholder="Almoço"></textarea>
                            </div>
                            
                            <label>Lanche</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="lancheusual" placeholder="Lanche"></textarea>
                            </div>
                            
                            <label>Jantar</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="jantarusual" placeholder="Jantar"></textarea>
                            </div>
                            
                            <label>Ceia</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="ceiausual" placeholder="Ceia"></textarea>
                            </div>
                            
							<br>
                            
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Salvar
                                    <i class="icon-floppy on-left" style="top: -3px; left: 7px">
                                    </i>
                                </button>
                                <!--<button type="button" onclick="zerar();" class="image-button danger image-left">
                                    Limpar
                                    <i class="icon-spin on-left" style="top: -2px; left: 7px">
                                    </i>
                                </button>-->
                                
                            </center>
                        </div>
                        
                        <div class="frame" id="_page_5">
                            <label>Café da Manhã</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="cafe" placeholder="Café da Manhã"></textarea>
                            </div>
                            
                            <label>Colação</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="colacao" placeholder="Colação"></textarea>
                            </div>
                            
                            <label>Almoço</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="almoco" placeholder="Almoço"></textarea>
                            </div>
                            
                            <label>Lanche</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="lanche" placeholder="Lanche"></textarea>
                            </div>
                            
                            <label>Jantar</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="jantar" placeholder="Jantar"></textarea>
                            </div>
                            
                            <label>Ceia</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="ceia" placeholder="Ceia"></textarea>
                            </div>
                            
                            <label>Não Gosta</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="naogosta" placeholder="Não Gosta"></textarea>
                            </div>
							<br>
                            
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Salvar
                                    <i class="icon-floppy on-left" style="top: -3px; left: 7px">
                                    </i>
                                </button>
                                <!--<button type="button" onclick="zerar();" class="image-button danger image-left">
                                    Limpar
                                    <i class="icon-spin on-left" style="top: -2px; left: 7px">
                                    </i>
                                </button>-->
                                
                            </center>
                        </div>
                        
                        <div class="frame" id="_page_6">
                            <label>Conduta</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="conduta" placeholder="Conduta" rows="10"></textarea>
                            </div>
                            <label>Observação</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="obs" placeholder="Observação" rows="10"></textarea>
                            </div>
							<br>
                            
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Salvar
                                    <i class="icon-floppy on-left" style="top: -3px; left: 7px">
                                    </i>
                                </button>
                                <!--<button type="button" onclick="zerar();" class="image-button danger image-left">
                                    Limpar
                                    <i class="icon-spin on-left" style="top: -2px; left: 7px">
                                    </i>
                                </button>-->
                                
                            </center>
                        </div>
                        
                    </div>
                </div>
                </div>
                </form>
            </div>
            <br>
            
        </div>
    </div>

</body>
<!-- FIM DO ARQUIVO -->

<!-- INCLUI O FIM DO ARQUIVO -->
<? include ("footer.php"); ?>