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

if (isset($_GET["codigoaut"])){
	$codigo = utf8_decode($_GET["codigoaut"]);
}else {if (isset($_POST["codigoaut"])){
	$codigo = utf8_decode($_POST["codigoaut"]);
}};

$sqlpac = "SELECT nome, id, convenio FROM pacientes WHERE codigo = '$codigo'";
$resultadopac = mysql_query($sqlpac);
$resultpac = mysql_fetch_array($resultadopac);
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
                <form method="POST" onsubmit="return valida(this);" action="salvaautmed.php" name="salvaautorizacaomedica" id="salvaautorizacaomedica">
                <div class="receituario">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                        <li class=""><a href="#_page_2">Informações</a></li>
                        <li class=""><a href="#_page_3">Exames</a></li>
                        <li class=""><a href="#_page_4">Dieta</a></li>
                        <li class=""><a href="#_page_5">Conduta</a></li>
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
                            <td bgcolor="#FDFDFD">
                                    <a class="button image-button primary image-left" name="buscarPaciente" href="buscarpacientereceituario.php"><i class="icon-search on-left" style="top: -3px; left: 7px"></i>Buscar</a>
                                </td> 
                            </tr></table>
                            <label>Nome</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" id="nome" name="nome" disabled="disabled" value="<? echo utf8_encode($resultpac[0])?>" placeholder="Nome do Paciente">
                                <input type="hidden" id="id" name="id" value="<? echo $resultpac[1];?>"> <!-- Envia o id do paciente -->
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Convênio</label>
                                <div class="input-control text size3" data-role="input-control">
	                                <input type="text" disabled="disabled" value="<? echo utf8_encode($resultpac[2]);?>" id="convenio" name="convenio" placeholder="Convênio">
	                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Data</label>
                                    <div class="input-control text" id="datepicker">
                                        <input type="text" name="data" placeholder="Data">
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
	                                <input type="text" id="pesoatual" name="pesoatual" placeholder="Peso Atual">
	                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Altura</label>
                                    <div class="input-control text size2" data-role="input-control">
                                        <input type="text" name="altura" placeholder="Altura">
                                    </div>
                                </td>
                                <br /></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                <label>IMC</label>
                                <div class="input-control text size2" data-role="input-control">
	                                <input type="text" id="imc" name="imc" placeholder="IMC">
	                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>CA</label>
                                <div class="input-control text size2" data-role="input-control">
	                                <input type="text" id="ca" name="ca" placeholder="CA">
	                            </div>
                            <br></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Peso Usual</label>
                                <div class="input-control text size2" data-role="input-control">
	                                <input type="text" id="pesousual" name="pesousual" placeholder="Peso Usual">
	                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>PA</label>
                                    <div class="input-control text size2" data-role="input-control">
                                        <input type="text" name="pa" placeholder="PA">
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
                                <input type="text" id="med" name="med" placeholder="Médico Assitente">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <label>Queixa Principal</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="queixa" placeholder="Queixa Principal"></textarea>
                            </div>
                            
                            <label>História Patológica Pregressa</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="histopato" placeholder="História Patológica Pregressa"></textarea>
                            </div>
                            
                            <label>Medicamentos Regulares</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="medreg" placeholder="Medicamentos Regulares"></textarea>
                            </div>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Alergia Medicamentosa</label>
                                <div class="input-control select">
	                                <select name="alergiamed">
	                                	<option value="">SELECIONE</option>
	                                	<option value="SIM">SIM</option>
	                                	<option value="NÃO">NÃO</option>
	                                </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Qual</label>
                                    <div class="input-control text size4" data-role="input-control">
                                        <input type="text" name="qualalergiamed" placeholder="Qual">
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
	                                	<option value="">SELECIONE</option>
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
	                                	<option value="">SELECIONE</option>
	                                	<option value="SIM">SIM</option>
	                                	<option value="NÃO">NÃO</option>
	                                </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Qual</label>
                                    <div class="input-control text size4" data-role="input-control">
                                        <input type="text" name="qualativfis" placeholder="Qual">
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
                                <input type="text" id="coltotal" name="coltotal" placeholder="Colesterol Total">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>HDL</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="hdl" name="hdl" placeholder="HDL">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>LDL</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="ldl" name="ldl" placeholder="LDL">
                            </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>VLDL</label>
                                <div class="input-control text size3" data-role="input-control">
                                <input type="text" id="vldl" name="vldl" placeholder="VLDL">
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
                        <div class="frame" id="_page_5">
                            <label>Conduta</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="conduta" placeholder="Conduta"></textarea>
                            </div>
                            <label>Observação</label>
                            <div class="input-control textarea" data-role="input-control">
                                <textarea name="obs" placeholder="Observação"></textarea>
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