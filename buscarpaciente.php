<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<!-- <script src="js/jquery-ui.min.js" type="text/javascript"></script>  SCRIPT AUTOCOMPLETE -->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->

    <script>
        //$(function() {
          //  jQuery(function($){
          //      $("#cpf").mask("999.999.999-99");
          //  });
        //});
        
        //function zerar() {
            //document.getElementById("divcpf").className = "input-control text";
            //document.getElementById("editarpaciente").reset();
            
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


    <!--<script type="text/javascript">
            $(document).ready(function(){
            $.ajax({
               url: 'buscaDados.php',
               type: 'POST',
               dataType: 'json',
               success: function(data){
                     $('#buscanome').autocomplete(
                     {
                           delay: 0,
                           source: data,
                           minLength: 2
                     });
               }
          });
    });
    </script>-->
    <style>
        .ui-helper-hidden-accessible {display: none; }
    </style>
    
    <?
    //Recebe as informacoes buscadas na busca de pacientes
    
    if (isset($_GET["codigopac"])){
    	$codigo = utf8_decode($_GET["codigopac"]);
    }else {if (isset($_POST["codigopac"])){
    	$codigo = utf8_decode($_POST["codigopac"]);
    }};
    
    $sqlpac = "SELECT nome FROM pacientes WHERE codigo = '$codigo'";
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
                <form method="POST" onsubmit="return valida(this);" action="editarpaciente.php" name="editarpaciente" id="editarpaciente">
                <div class="buscapaciente">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Buscar Dados</a></li>                        
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
                                    <a class="button image-button primary image-left" name="buscarPaciente" href="buscarpacienteeditar.php"><i class="icon-search on-left" style="top: -3px; left: 7px"></i>Buscar</a>
                                </td> 
                            </tr></table>
                        	<br />
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Procurar
                                    <i class="icon-search on-left" style="top: -3px; left: 7px">
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