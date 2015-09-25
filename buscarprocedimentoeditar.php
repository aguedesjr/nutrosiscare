<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<!-- <script src="js/jquery-ui.min.js" type="text/javascript"></script>  SCRIPT AUTOCOMPLETE -->

    <style>
        .ui-helper-hidden-accessible {display: none; }
    </style>

<!-- BUSCA OS PROFISSIONAIS -->    
<?
$sql = "SELECT nome, id FROM convenios";
$resultado = mysql_query($sql);
?>

<script>
        $(function() {
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
        });
    </script>

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
                <form method="POST" action="editarprocedimento.php" name="editarprocedimento" id="editarprocedimento">
                <div class="editarprocedimento">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Buscar Dados</a></li>                        
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Convênio</label>
                            <div class="input-control select">
                                <select name="convenio" id="convenio">
                                    <option value="">SELECIONE</option>
                                    <? while ($linhas = mysql_fetch_array($resultado, MYSQL_NUM)){ ?>
                                    <option value=<? echo $linhas[1];?>><? echo utf8_encode($linhas[0]);?></option>
                                    <?};?>
                                </select>
                            </div><br />
                            <label>Procedimento</label>
                            <div class="input-control select">
                                <select name="procedimento" id="procedimento">
                                </select>
                            </div><br />
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