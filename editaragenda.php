<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php");

if (isset($_GET["id"])){
    $id = utf8_decode($_GET["id"]);
}else {if (isset($_POST["id"])){
    $id = utf8_decode($_POST["id"]);
}}; 

if (isset($_GET["data"])){
        $data = utf8_decode($_GET["data"]);
    }else {if (isset($_POST["data"])){
        $data = utf8_decode($_POST["data"]);
}};

if (isset($_GET["profissional"])){
        $profissional = utf8_decode($_GET["profissional"]);
    }else {if (isset($_POST["profissional"])){
        $profissional = utf8_decode($_POST["profissional"]);
}};

//Busca as informacoes da agenda
$sqla = "SELECT codprof, nomepaciente, data, horario FROM agenda WHERE id = '$id'";
$resultadoa = mysql_query($sqla);
$resulta = mysql_fetch_array($resultadoa);

//Busca o nome dos profissionais
$sqlp = "SELECT nome FROM profissionais WHERE id = '$profissional'";
$resultadop = mysql_query($sqlp);
$resultp = mysql_fetch_array($resultadop);

//Busca o nome dos profissionais para a combo
$sqlprof = "SELECT id, nome FROM profissionais";
$resultadoprof = mysql_query($sqlprof);

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
    
    <center><img src="imagens/principal1.png" /></center>
    <br><br>
    
    <div class="grid">
        <div class="row">
            
            <? include ("menu.php"); ?>
            <div class="span1"></div>
            <div class="span10">
                <div class="agenda">
                    <div class="tab-control" data-role="tab-control">
                        <ul class="tabs">
                            <li class="active"><a href="#_page_1">Horários</a></li>
                        </ul>
                        <div class="frames">
                            <div class="frame" id="_page_1">
                                <form method="POST" action="editaragendabd.php" name="editaragenda">
                                <center><h4><? echo 'Dr(a). '.utf8_encode($resultp[0]);?></h4></center>
                                
                                <table>
                                    <tr>
                                        <td bgcolor="#FDFDFD">
                                            <label>Nome</label>
                                            <div class="input-control text size5" data-role="input-control">
                                                <input type="text" id="nome" name="nome" placeholder="Nome" value="<? echo utf8_encode($resulta[1]);?>">
                                            </div>
                                        </td>
                                        <td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                        <td bgcolor="#FDFDFD">
                                                <label>Data</label>
                                                <div class="input-control text" id="datepicker">
                                                    <input type="text" name="data" placeholder="Data" value="<? echo $data;?>">
                                                    <button class="btn-date"></button>
                                                </div>
                                        </td>
                                        <td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                        <td bgcolor="#FDFDFD">
                                            <label>Horario</label>
                                            <div class="input-control select">
                                            <select name="horario">
                                                    <option value="<? echo $resulta[3];?>"><? echo $resulta[3];?></option>
                                                    <option value="">---------</option>
                                                    <?
                                                    for ($i = 07; $i < 21; $i++) {
                                                        $num = $i > 23 ? $i - 24 : $i;
                                                        $num = $num < 10 ? "0$num" : $num;
                                                        $ampm = $num > 11 && $num < 24 ? 'PM' : 'AM';
                                                        echo "<option value=\"$num:00\"> $num:00 $ampm</option>\n";
                                                        if ($num != 5)
                                                        	echo "<option value=\"$num:15\"> $num:15 $ampm</option>\n";
                                                        if ($num != 5)
                                                            echo "<option value=\"$num:30\"> $num:30 $ampm</option>\n";
                                                        if ($num != 5)
                                                        	echo "<option value=\"$num:45\"> $num:45 $ampm</option>\n";
                                                    }
                                                    $num = 21;
                                                    echo "<option value=\"$num:00\"> $num:00 $ampm</option>\n";
                                                    ?>
                                            </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td bgcolor="#FDFDFD">
                                                <label>Profissional</label>
                                                <div class="input-control select">
                                                    <select name="profissional">
                                                        <option value="<? echo $resulta[0];?>"><? echo utf8_encode($resultp[0]);?></option>
														<option value="">---------</option>
                                                        <? while ($linhasprof = mysql_fetch_array($resultadoprof, MYSQL_NUM)){ ?>
															<option value=<? echo $linhasprof[0];?>><? echo utf8_encode($linhasprof[1]);?></option>
														<?};?>
                                                    </select>
                                                </div>
                                            </td>
                                    </tr>
                                </table><br />
                                
                                <center>
                                    <button type="submit" class="image-button primary image-left">
                                            Salvar
                                            <i class="icon-floppy on-left" style="top: -3px; left: 7px">
                                            </i>
                                    </button>
                                </center>
                                <!-- <input type="hidden" name="profissional" value="<? echo $profissional;?>"> -->
                                <input type="hidden" name="id" value="<? echo $id;?>">
                                </form>    
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