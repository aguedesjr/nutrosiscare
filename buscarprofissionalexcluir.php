<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<!-- <script src="js/jquery-ui.min.js" type="text/javascript"></script>  SCRIPT AUTOCOMPLETE -->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->

    <style>
        .ui-helper-hidden-accessible {display: none; }
    </style>

<!-- BUSCA OS PROFISSIONAIS -->    
<?
$sql = "SELECT nome, id FROM profissionais";
$resultado = mysql_query($sql);
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
                <form method="POST" action="excluirprofissional.php" name="excluirprofissional" id="excluirprofissional">
                <div class="buscaprofissional">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Buscar Dados</a></li>                        
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Profissional</label>
                            <div class="input-control select">
                                <select name="profissional">
                                    <option value="">SELECIONE</option>
                                    <? while ($linhas = mysql_fetch_array($resultado, MYSQL_NUM)){ ?>
                                    <option value=<? echo $linhas[1];?>><? echo utf8_encode($linhas[0]);?></option>
                                    <?};?>
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