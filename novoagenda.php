<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php"); 

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

//Busca o nome dos profissionais
$sqlp = "SELECT nome FROM profissionais WHERE id = '$profissional'";
$resultadop = mysql_query($sqlp);
$resultp = mysql_fetch_array($resultadop);

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
                <div class="agenda">
                    <div class="tab-control" data-role="tab-control">
                        <ul class="tabs">
                            <li class="active"><a href="#_page_1">Horários</a></li>
                        </ul>
                        <div class="frames">
                            <div class="frame" id="_page_1">
                                <form method="POST" action="salvaragendabd.php" name="salvaagenda">
                                <center><h4><? echo 'Dr(a). '.utf8_encode($resultp[0]);?></h4></center>
                                <center><h5><? echo 'Data: '.utf8_encode($data);?></h5></center>
                                
                                <table>
                                    <tr>
                                        <td bgcolor="#FDFDFD">
                                            <label>Nome</label>
                                            <div class="input-control text size5" data-role="input-control">
                                                <input type="text" id="nome" name="nome" placeholder="Nome">
                                            </div>
                                        </td>
                                        <td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                        <td bgcolor="#FDFDFD">
                                            <label>Horario</label>
                                            <div class="input-control select">
                                            <select name="horario">
                                                    <option value="">SELECIONE</option>
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
                                </table><br />
                                
                                <center>
                                    <button type="submit" class="image-button primary image-left">
                                            Salvar
                                            <i class="icon-floppy on-left" style="top: -3px; left: 7px">
                                            </i>
                                    </button>
                                </center>
                                <input type="hidden" name="profissional" value="<? echo $profissional;?>">
                                <input type="hidden" name="data" value="<? echo $data;?>">
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