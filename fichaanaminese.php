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
            
            $('#convenio').change(function(){
                if( $(this).val() ) {                   
                    $.getJSON('getproc.php?search=',{convenio: $(this).val(), ajax: 'true'}, function(j){
                        var options = '<option value=""></option>'; 
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].id + '">' + j[i].nome + '</option>';    
                        }
                        $('#procedimento').html(options).show();
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
            
            $('#convenio').change(function(){
                if( $(this).val() ) {                   
                    $.getJSON('getprod.php?search=',{convenio: $(this).val(), ajax: 'true'}, function(j){
                        var options = '<option value=" "></option>'; 
                        for (var i = 0; i < j.length; i++) {
                            options += '<option value="' + j[i].codigo + '">' + j[i].codigo + '</option>';  
                        }
                        $('#codconvenio').html(options).show();
                        $('#codconvenio2').html(options).show();
                        $('#codconvenio3').html(options).show();
                        $('#codconvenio4').html(options).show();
                        $('#codconvenio5').html(options).show();
                        $('#codconvenio6').html(options).show();
                        $('#codconvenio7').html(options).show();
                        $('#codconvenio8').html(options).show();
                        $('#codconvenio9').html(options).show();
                        $('#codconvenio10').html(options).show();
                    });
                }
            });
            $('#codconvenio').change(function(){

            	if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   //Verifica se o codigo retornado é vazio. Se sim, subtrai o valor da linha do total
                   if (cod == " "){
                       total = total - aux[0];
                       document.getElementById("proc").innerHTML = " ";
                       document.getElementById("valor").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                           $("input[name='proc']").val(data);
                           document.getElementById("proc").innerHTML = data;
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){   
                           $("input[name='valor']").val(data1);
                           total = parseFloat(total) + parseFloat(data1);
                           aux[0] = parseFloat(data1);
                           document.getElementById("valor").innerHTML = "R$ " + data1;
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio2').change(function(){
          
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[1];
                       document.getElementById("proc2").innerHTML = " ";
                       document.getElementById("valor2").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                           $("input[name='proc2']").val(data);
                           document.getElementById("proc2").innerHTML = data;
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){  
                           $("input[name='valor2']").val(data1);
                           total = parseFloat(total) + parseFloat(data1);
                           aux[1] = parseFloat(data1);
                           document.getElementById("valor2").innerHTML = "R$ " + data1;
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio3').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[2];
                       document.getElementById("proc3").innerHTML = " ";
                       document.getElementById("valor3").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                           $("input[name='proc3']").val(data);
                           document.getElementById("proc3").innerHTML = data;
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){  
                           $("input[name='valor3']").val(data1);
                           document.getElementById("valor3").innerHTML = "R$ " + data1;
                           total = parseFloat(total) + parseFloat(data1);
                           aux[2] = parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio4').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[3];
                       document.getElementById("proc4").innerHTML = " ";
                       document.getElementById("valor4").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                           $("input[name='proc4']").val(data);
                           document.getElementById("proc4").innerHTML = data;
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){
                            document.getElementById("valor4").innerHTML = "R$ " + data1;
                            $("input[name='valor4']").val(data1);
                            total = parseFloat(total) + parseFloat(data1);
                            aux[3] = parseFloat(data1);
                            document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio5').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[4];
                       document.getElementById("proc5").innerHTML = " ";
                       document.getElementById("valor5").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                           $("input[name='proc5']").val(data);
                           document.getElementById("proc5").innerHTML = data;
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){
                           document.getElementById("valor5").innerHTML = "R$ " + data1;  
                           $("input[name='valor5']").val(data1);
                           total = parseFloat(total) + parseFloat(data1);
                           aux[4] = parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio6').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[5];
                       document.getElementById("proc6").innerHTML = " ";
                       document.getElementById("valor6").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                           $("input[name='proc6']").val(data);
                           document.getElementById("proc6").innerHTML = data;
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){
                           document.getElementById("valor6").innerHTML = "R$ " + data1;  
                           $("input[name='valor6']").val(data1);
                           total = parseFloat(total) + parseFloat(data1);
                           aux[5] = parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio7').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[6];
                       document.getElementById("proc7").innerHTML = " ";
                       document.getElementById("valor7").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                             document.getElementById("proc7").innerHTML = data;
                             $("input[name='proc7']").val(data);
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){
                           document.getElementById("valor7").innerHTML = "R$ " + data1;  
                           $("input[name='valor7']").val(data1);
                           total = parseFloat(total) + parseFloat(data1);
                           aux[6] = parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio8').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[7];
                       document.getElementById("proc8").innerHTML = " ";
                       document.getElementById("valor8").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                             document.getElementById("proc8").innerHTML = data;
                             $("input[name='proc8']").val(data);
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){
                           document.getElementById("valor8").innerHTML = "R$ " + data1;  
                           $("input[name='valor8']").val(data1);
                           total = parseFloat(total) + parseFloat(data1);
                           aux[7] = parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio9').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[8];
                       document.getElementById("proc9").innerHTML = " ";
                       document.getElementById("valor9").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                             document.getElementById("proc9").innerHTML = data;
                             $("input[name='proc9']").val(data);
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){
                           document.getElementById("valor9").innerHTML = "R$ " + data1;  
                           $("input[name='valor9']").val(data1);
                           total = parseFloat(total) + parseFloat(data1);
                           aux[8] = parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
            $('#codconvenio10').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   if (cod == " "){
                       total = total - aux[9];
                       document.getElementById("proc10").innerHTML = " ";
                       document.getElementById("valor10").innerHTML = " ";
                       document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                   }
                   else {
                   $.ajax({
                         url: 'getinfo.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data){
                             document.getElementById("proc10").innerHTML = data;
                             $("input[name='proc10']").val(data);
                          }
                   });
                   $.ajax({
                         url: 'getpreco.php',
                         //dataType: 'html',
                         data: {codigo:cod, convenio:conv},
                         success: function(data1){
                           document.getElementById("valor10").innerHTML = "R$ " + data1; 
                           $("input[name='valor10']").val(data1);
                           total = parseFloat(total) + parseFloat(data1);
                           aux[9] = parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }}
            });
        });
    </script>
    
<?
$sql = "SELECT nome, id FROM convenios";
$resultado = mysql_query($sql);

$sqlp = "SELECT nome, id FROM profissionais WHERE tipo = 'CRM'";
$resultadop = mysql_query($sqlp);

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
    
    <center><img src="imagens/principal1.png" /></center>
    <br><br>
    
    <div class="grid">
        <div class="row">
    
            <? include ("menu.php"); ?>
            <div class="span1"></div>
            <div class="span10">
                <form method="POST" onsubmit="return valida(this);" action="salvaautmed.php" name="salvaautorizacaomedica" id="salvaautorizacaomedica">
                <div class="fichaanaminese">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                        <li class=""><a href="#_page_2">Colesterol</a></li>
                        <li class=""><a href="#_page_3">Conduta</a></li>
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
                                    <a class="button image-button primary image-left" name="buscarPaciente" href="buscarpacienteanaminese.php"><i class="icon-search on-left" style="top: -3px; left: 7px"></i>Buscar</a>
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
                        
                        <div class="frame" id="_page_3">
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