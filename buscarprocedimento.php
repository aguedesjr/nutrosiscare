<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php"); 

//Busca o nome do convenio
$sql = "SELECT nome, id FROM convenios";
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
                <form method="POST" action="listarprocedimento.php" name="listarprocedimento">
                    <div class="listarprocedimento">
                        <div class="tab-control" data-role="tab-control">
                            <ul class="tabs">
                                <li class="active"><a href="#_page_1">Informações</a></li>
                            </ul>
                            <div class="frames">
                                <div class="frame" id="_page_1">
                                    <table>
                                        <tr>
                                            <td bgcolor="#FDFDFD">
                                                <label>Convênio</label>
                                                <div class="input-control select">
                                                    <select name="convenio">
                                                        <option value="">SELECIONE</option>
                                                        <? while ($linhas = mysql_fetch_array($resultado, MYSQL_NUM)){ ?>
                                                        <option value=<? echo $linhas[1];?>><? echo utf8_encode($linhas[0]);?></option>
                                                        <?};?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </table><br />
                                    <center>
                                        <button type="submit" class="image-button primary image-left">
                                            Procurar
                                            <i class="icon-search on-left" style="top: -3px; left: 7px">
                                            </i>
                                        </button>
                                    </center>
                                </div>
                            </div>    
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<!-- FIM DO ARQUIVO -->

<!-- INCLUI O FIM DO ARQUIVO -->
<? include ("footer.php"); ?>