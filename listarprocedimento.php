<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php"); 

if (isset($_GET["convenio"])){
        $convenio = utf8_decode($_GET["convenio"]);
    }else {if (isset($_POST["convenio"])){
        $convenio = utf8_decode($_POST["convenio"]);
}};

//Busca informacoes do procedimento
$sqlp = "SELECT codigo, nome, valor FROM procedimentos WHERE convenio = '$convenio' ORDER BY codigo";
$resultadop = mysql_query($sqlp);

//Busca informacoes do convenio
$sqlc = "SELECT nome FROM convenios WHERE id = '$convenio'";
$resultadoc = mysql_query($sqlc);
$resultc = mysql_fetch_array($resultadoc);

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
                <div class="listarprocedimento">
                    <div class="tab-control" data-role="tab-control">
                        <ul class="tabs">
                            <li class="active"><a href="#_page_1">Procedimento</a></li>
                        </ul>
                        <div class="frames">
                            <div class="frame" id="_page_1">
                                <center><h4><? echo utf8_encode($resultc[0]);?></h4></center>
                                
                                <!-- TABELA COM OS HORÁRIOS AGENDADOS -->
                                
                                <table class="table striped">
                                    <thead>
                                        <tr>
                                            <th bgcolor="#FDFDFD" align="left">Código</th>
                                            <th bgcolor="#FDFDFD" align="left">Nome</th>
                                            <th bgcolor="#FDFDFD" align="left">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? while ($linhasp = mysql_fetch_array($resultadop, MYSQL_NUM)){ ?>
                                        <tr>
                                            <td><? echo utf8_encode($linhasp[0]);?></td>
                                            <td><? echo utf8_encode($linhasp[1]);?></td>
                                            <td><? echo utf8_encode($linhasp[2]);?></td>
                                        </tr>
                                        <?};?>
                                    </tbody>
                                </table><br />
                                
                                <!-- FIM DA TABELA HORÁRIOS AGENDADOS -->
                                <center>
                                    <a class="button image-button primary image-left" name="novo" href="novoagenda.php?data=<? echo $data;?>&profissional=<? echo $profissional;?>"><i class="icon-new on-left" style="top: -3px; left: 7px"></i>Novo</a>
                                </center>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
<!-- FIM DO ARQUIVO --> 

<!-- INCLUI O FIM DO ARQUIVO -->
<? include ("footer.php"); ?>