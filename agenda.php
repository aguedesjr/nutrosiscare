<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php"); 

//Busca o nome dos profissionais
$sqlp = "SELECT id, nome FROM profissionais";
$resultadop = mysql_query($sqlp);

?>

<script src="js/metro-calendar.js"></script>
<script src="js/metro-datepicker.js"></script>

<script>
$(function() {
    $("#datepicker").datepicker({
        //date: "2013-01-01", // set init date
        format: "dd/mm/yyyy", // set output format
        effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: 'pt', // 'ru' or 'en', default is $.Metro.currentLocale (metro-locale.js)
    });
});
</script>

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
                <form method="POST" action="buscaragenda.php" name="buscaragenda">
                    <div class="agenda">
                        <div class="tab-control" data-role="tab-control">
                            <ul class="tabs">
                                <li class="active"><a href="#_page_1">Informações</a></li>
                            </ul>
                            <div class="frames">
                                <div class="frame" id="_page_1">
                                    <table>
                                        <tr>
                                            <td bgcolor="#FDFDFD">
                                                <label>Data</label>
                                                <div class="input-control text" id="datepicker">
                                                    <input type="text" name="data" placeholder="Data">
                                                    <button class="btn-date"></button>
                                                </div>
                                            </td>
                                            <td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                            <td bgcolor="#FDFDFD">
                                                <label>Profissional</label>
                                                <div class="input-control select">
                                                    <select name="profissional">
                                                        <option value="">SELECIONE</option>
                                                        <? while ($linhasp = mysql_fetch_array($resultadop, MYSQL_NUM)){ ?>
                                                        <option value=<? echo $linhasp[0];?>><? echo utf8_encode($linhasp[1]);?></option>
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