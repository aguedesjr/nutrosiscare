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

//Data no formato do banco de dados
$datan = implode("-", array_reverse(explode("/", $data)));

//Busca o nome dos profissionais
$sqlp = "SELECT nome FROM profissionais WHERE id = '$profissional'";
$resultadop = mysql_query($sqlp);
$resultp = mysql_fetch_array($resultadop);

//Busca os horarios dos profissionais
$sqlh = "SELECT nomepaciente, horario, id FROM agenda WHERE codprof = '$profissional' AND data = '$datan' ORDER BY horario";
$resultadoh = mysql_query($sqlh);

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
                                <center><h4><? echo 'Dr(a). '.utf8_encode($resultp[0]);?></h4></center>
                                <center><h5><? echo 'Data: '.utf8_encode($data);?></h5></center>
                                
                                <!-- TABELA COM OS HORÁRIOS AGENDADOS -->
                                
                                <table class="table striped">
                                    <thead>
                                        <tr>
                                            <th bgcolor="#FDFDFD" align="left">Nome</th>
                                            <th bgcolor="#FDFDFD" align="left">Horário</th>
                                            <th bgcolor="#FDFDFD" align="left">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? while ($linhash = mysql_fetch_array($resultadoh, MYSQL_NUM)){ ?>
                                        <tr>
                                            <td><? echo utf8_encode($linhash[0]);?></td>
                                            <td><? echo $linhash[1];?></td>
                                            <td>
                                                <a class="button image-button primary image-left" name="editar" href="editaragenda.php?id=<? echo $linhash[2];?>&data=<? echo $data;?>&profissional=<? echo $profissional;?>"><i class="icon-pencil on-left" style="top: -3px; left: 7px"></i>Editar</a>
                                                &nbsp;&nbsp;
                                                <a class="button image-button danger image-left" name="excluir" href="excluiragendabd.php?id=<? echo $linhash[2];?>&data=<? echo $data;?>&profissional=<? echo $profissional;?>"><i class="icon-cancel-2 on-left" style="top: -3px; left: 7px"></i>Excluir</a>
                                            </td>
                                        </tr>
                                        <?};?>
                                    </tbody>
                                </table><br />
                                
                                <!-- FIM DA TABELA HORÁRIOS AGENDADOS -->
                                <center>
                                    <a class="button image-button primary image-left" name="voltar" href="agenda.php"><i class="icon-arrow-left on-left" style="top: -3px; left: 7px"></i>Voltar</a>
                                    <a class="button image-button primary image-left" name="imprimir" href="imprimiragenda.php?data=<? echo $data;?>&profissional=<? echo $profissional;?>"><i class="icon-printer on-left" style="top: -3px; left: 7px"></i>Imprimir</a>
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