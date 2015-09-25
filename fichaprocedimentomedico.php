<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<!-- BUSCA DAS INFORMAÇÕES -->
<?

if (isset($_GET["codigo"])){
        $codigo = utf8_decode($_GET["codigo"]);
}else {if (isset($_POST["codigo"])){
        $codigo = utf8_decode($_POST["codigo"]);
}};

//Busca informacoes da ficha de autorizacao
$sqla = "SELECT profissional, paciente, convenio, data FROM autorizacao WHERE id = '$codigo'";
$resultadoa = mysql_query($sqla);
$linhasa = mysql_fetch_array($resultadoa);

//Busca informacoes do paciente
$sqlpac = "SELECT nome, codigo FROM pacientes WHERE id = '$linhasa[1]'";
$resultadopac = mysql_query($sqlpac);
$linhaspac = mysql_fetch_array($resultadopac);

//Busca informacoes do profissional atual
$sqlprof = "SELECT nome, id FROM profissionais WHERE id = '$linhasa[0]'";
$resultadoprof = mysql_query($sqlprof);
$linhasprof = mysql_fetch_array($resultadoprof);

//Busca informacoes do convenio atual
$sqlconv = "SELECT nome, id FROM convenios WHERE id = '$linhasa[2]'";
$resultadoconv = mysql_query($sqlconv);
$linhasconv = mysql_fetch_array($resultadoconv);    

//Busca o nome dos convenios
$sql = "SELECT id, nome FROM convenios";
$resultado = mysql_query($sql);

//Busca o nome dos profissionais
$sqlp = "SELECT id, nome FROM profissionais WHERE tipo = 'CRO'";
$resultadop = mysql_query($sqlp);

//Busca informacoes dos codigos autorizados
$sqlcod = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod = mysql_query($sqlcod);

//Busca informacoes dos codigos autorizados
$sqlcod2 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod2 = mysql_query($sqlcod2);

//Busca informacoes dos codigos autorizados
$sqlcod3 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod3 = mysql_query($sqlcod3);

//Busca informacoes dos codigos autorizados
$sqlcod4 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod4 = mysql_query($sqlcod4);

//Busca informacoes dos codigos autorizados
$sqlcod5 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod5 = mysql_query($sqlcod5);

//Busca informacoes dos codigos autorizados
$sqlcod6 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod6 = mysql_query($sqlcod6);

//Busca informacoes dos codigos autorizados
$sqlcod7 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod7 = mysql_query($sqlcod7);

//Busca informacoes dos codigos autorizados
$sqlcod8 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod8 = mysql_query($sqlcod8);

//Busca informacoes dos codigos autorizados
$sqlcod9 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod9 = mysql_query($sqlcod9);

//Busca informacoes dos codigos autorizados
$sqlcod10 = "SELECT codconvenio FROM autorizacao_codigoconvenio WHERE codautorizacao = '$codigo'";
$resultadocod10 = mysql_query($sqlcod10);

?>

<script src="js/cep.js" type="text/javascript"></script> <!-- SCRIPT CEP -->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->
<script src="js/maskMoney.js" type="text/javascript"></script> <!-- SCRIPT MASK MONEY -->

    <script>
                
        //function zerar() {
          //  document.getElementById("divcpf").className = "input-control text";
          //  document.getElementById("divnome").className = "input-control text";
          //  document.getElementById("salvapaciente").reset();
            
        //}
        
        function valida(form) {
            //if (form.cpf.value=="") {
                //alert("CPF não informado!!");
                //document.getElementById("divcpf").className = "input-control text size2 error-state";
                //form.cpf.focus();
                //return false;
            //}
            
            //if (form.cpf.value!="") {
                //document.getElementById("divcpf").className = "input-control text size2";
            //}
        };

        $(document).ready(function(){
            $("input.dinheiro").maskMoney({showSymbol:false, symbol:"R$", decimal:",", thousands:"."});
      	});
        
    </script>
    
    <script>

    	var total = 0;

	    function calcValor(){
			
			var valorfinal = 0;
	    	var desconto = parseFloat(document.getElementById("desconto").value);
	    	//alert(valorcalculado);
			//alert(desconto);
	    	valorfinal = parseFloat(total) - parseFloat(desconto);
	
	    	document.getElementById("total").innerHTML = "Total: R$ " + valorfinal + ",00";
	
	    }
	
        $(function() {
            
            jQuery(function($){
                $("#cpf").mask("999.999.999-99");
            });
            
            $('#cpf').change(function(){
                if( $(this).val() ) {                   
                    $.getJSON('getnome.php?search=',{cpf: $(this).val(), ajax: 'true'}, function(j){ 
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
                        var options = '<option value=""></option>'; 
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
                   var aux = '';
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
                           document.getElementById("valor").innerHTML = "R$ " + data1;
                           total = parseFloat(total) + parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio2').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                           document.getElementById("valor2").innerHTML = "R$ " + data1;
                           total = parseFloat(total) + parseFloat(data1);
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio3').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio4').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                            document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio5').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio6').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio7').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio8').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio9').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
            $('#codconvenio10').change(function(){
                if( $(this).val() ) {
                    
                   var cod = $(this).val();
                   var conv = $('#convenio').val();
                   var aux = '';
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
                           document.getElementById("total").innerHTML = "Total: R$ " + total + ",00";
                          }
                   });
                }
            });
        });
    </script>
    
<?
$sql = "SELECT nome, id FROM convenios";
$resultado = mysql_query($sql);

$sqlp = "SELECT nome, id FROM profissionais WHERE tipo = 'CRO'";
$resultadop = mysql_query($sqlp);
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
                <form method="POST" onsubmit="return valida(this);" action="salvaproc.php" name="salvaprocedimento" id="salvaprocedimento">
                <div class="fichaprocedimento">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Codigo</label>
                            <div class="input-control text size2" id="divcpf" data-role="input-control">
                                <input type="text" readonly="readonly" id="codigo" name="codigo" value="<? echo $linhaspac[1];?>" placeholder="Codigo do Paciente">
                            </div>
                            <label>Nome</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" id="nome" name="nome" disabled="disabled" value="<? echo $linhaspac[0];?>" placeholder="Nome do Paciente">
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Convênio</label>
                                <div class="input-control text" data-role="input-control">
                                        <input type="text" name="convenio1" id="convenio1" value="<? echo utf8_encode($linhasconv[0]);?>" placeholder="Convenio">
                                        <input type="hidden" name="convenio" id="convenio" value="<? echo utf8_encode($linhasconv[1]);?>"/>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Profissional</label>
                                <div class="input-control select">
                                    <select name="profissional" id="profissional">
                                        <option value="<? echo $linhasprof[1];?>"><? echo utf8_encode($linhasprof[0]); ?></option>
                                        <option value="">--------</option>
                                        <? while ($linhasp = mysql_fetch_array($resultadop, MYSQL_NUM)){ ?>
                                        <option value=<? echo $linhasp[1];?>><? echo utf8_encode($linhasp[0]);?></option>
                                        <?};?>
                                    </select>
                                </div><br /></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <td bgcolor="#FDFDFD">
                                    <label>Data</label>
                                    <div class="input-control text" id="datepicker">
                                        <input type="text" name="data" readonly="readonly" value="<? echo date("d/m/Y");?>" placeholder="Data">
                                        <button class="btn-date"></button>
                                    </div>
                                </td>
                                <br /></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr>
                            </table>
                            
                            <label>Observação</label>
                            <div class="input-control text" data-role="input-control">
                                <input type="text" name="obs" placeholder="Observação">
                            </div>
                            
                            <!-- TABELA COM OS PROCEDIMENTOS -->
                                
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th bgcolor="#FDFDFD" align="left">Código</th>
                                            <th bgcolor="#FDFDFD" align="left">Procedimento</th>
                                            <th bgcolor="#FDFDFD" align="left">Dente</th>
                                            <th bgcolor="#FDFDFD" align="left">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio" id="codconvenio">
                                                    <option value=""></option>
                                                    <? while ($linhascod = mysql_fetch_array($resultadocod, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod[0];?>><? echo $linhascod[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc"></label></td><input type="hidden" name="proc" value="" />
                                            <td><label id="valor"></label></td><input type="hidden" name="valor" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio2" id="codconvenio2">
                                                    <option value=""></option>
                                                    <? while ($linhascod2 = mysql_fetch_array($resultadocod2, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod2[0];?>><? echo $linhascod2[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc2"></label></td><input type="hidden" name="proc2" value="" />
                                            <td><label id="valor2"></label></td><input type="hidden" name="valor2" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio3" id="codconvenio3">
                                                    <option value=""></option>
                                                    <? while ($linhascod3 = mysql_fetch_array($resultadocod3, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod3[0];?>><? echo $linhascod3[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc3"></label></td><input type="hidden" name="proc3" value="" />
                                            <td><label id="valor3"></label></td><input type="hidden" name="valor3" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio4" id="codconvenio4">
                                                    <option value=""></option>
                                                    <? while ($linhascod4 = mysql_fetch_array($resultadocod4, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod4[0];?>><? echo $linhascod4[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc4"></label></td><input type="hidden" name="proc4" value="" />
                                            <td><label id="valor4"></label></td><input type="hidden" name="valor4" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio5" id="codconvenio5">
                                                    <option value=""></option>
                                                    <? while ($linhascod5 = mysql_fetch_array($resultadocod5, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod5[0];?>><? echo $linhascod5[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc5"></label></td><input type="hidden" name="proc5" value="" />
                                            <td><label id="valor5"></label></td><input type="hidden" name="valor5" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio6" id="codconvenio6">
                                                    <option value=""></option>
                                                    <? while ($linhascod6 = mysql_fetch_array($resultadocod6, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod6[0];?>><? echo $linhascod6[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc6"></label></td><input type="hidden" name="proc6" value="" />
                                            <td><label id="valor6"></label></td><input type="hidden" name="valor6" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio7" id="codconvenio7">
                                                    <option value=""></option>
                                                    <? while ($linhascod7 = mysql_fetch_array($resultadocod7, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod7[0];?>><? echo $linhascod7[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc7"></label></td><input type="hidden" name="proc7" value="" />
                                            <td><label id="valor7"></label></td><input type="hidden" name="valor7" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio8" id="codconvenio8">
                                                    <option value=""></option>
                                                    <? while ($linhascod8 = mysql_fetch_array($resultadocod8, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod8[0];?>><? echo $linhascod8[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc8"></label></td><input type="hidden" name="proc8" value="" />
                                            <td><label id="valor8"></label></td><input type="hidden" name="valor8" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio9" id="codconvenio9">
                                                    <option value=""></option>
                                                    <? while ($linhascod9 = mysql_fetch_array($resultadocod9, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod9[0];?>><? echo $linhascod9[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc9"></label></td><input type="hidden" name="proc9" value="" />
                                            <td><label id="valor9"></label></td><input type="hidden" name="valor9" value="" />
                                        </tr>
                                        <tr>
                                            <td><div class="input-control select">
                                                <select name="codconvenio10" id="codconvenio10">
                                                    <option value=""></option>
                                                    <? while ($linhascod10 = mysql_fetch_array($resultadocod10, MYSQL_NUM)){ ?>
                                                    <option value=<? echo $linhascod10[0];?>><? echo $linhascod10[0];?></option>
                                                    <?};?>
                                                </select></div></td>
                                            <td><label id="proc10"></label></td><input type="hidden" name="proc10" value="" />
                                            <td><label id="valor10"></label></td><input type="hidden" name="valor10" value="" />
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="span6"></div>
                                <table>
                                	<tr>
                                     	<td><label>Desconto R$:</label><div class="input-control text size2" data-role="input-control"><input type="text" id="desconto" name="desconto" class="dinheiro" onblur="calcValor()" placeholder="Desconto R$"></div></td>
                                    </tr>
                                </table><br />
                                
                                <!-- FIM DA TABELA PROCEDIMENTOS -->
                                
                                <!-- VALOR TOTAL DO PROCEDIMENTO -->
                                
                                <div class="span6"></div>
                               	<table>
                               		<tr>
                                		<td><label id="total">Total: R$ 0,00</label></td>
                                	</tr>
                                </table>
                                <br>
                                
                                <!-- FIM DO VALOR TOTAL DO PROCEDIMENTO -->
                            
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