<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php"); 

if (isset($_GET["nome"])){
        $nome = utf8_decode($_GET["nome"]);
    }else {if (isset($_POST["nome"])){
        $nome = utf8_decode($_POST["nome"]);
}};

if (isset($_GET["mes"])){
        $mes = utf8_decode($_GET["mes"]);
    }else {if (isset($_POST["mes"])){
        $mes = utf8_decode($_POST["mes"]);
}};

if (isset($_GET["ano"])){
	$ano = utf8_decode($_GET["ano"]);
}else {if (isset($_POST["ano"])){
	$ano = utf8_decode($_POST["ano"]);
}};

//Buscar o nome do paciente na agendda e retornar as informações
$sqlbuscapac = "SELECT nomepaciente, codprof, data, horario FROM agenda WHERE nomepaciente LIKE '$nome%' AND data LIKE '$ano-$mes-%' ORDER BY nomepaciente;";
$resultadobuscapac = mysql_query($sqlbuscapac);
//$resultbuscapac = mysql_fetch_array($resultadobuscapac);

//Data no formato do banco de dados
$datan = implode("-", array_reverse(explode("/", $data)));

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
            <div class="span17">
                <div class="agenda">
                    <div class="tab-control" data-role="tab-control">
                        <ul class="tabs">
                            <li class="active"><a href="#_page_1">Agenda</a></li>
                        </ul>
                        <div class="frames">
                            <div class="frame" id="_page_1">
                                <center><h4><? echo 'Consultar Agenda por Paciente';?></h4></center>
                                
                                <!-- TABELA COM OS HORÁRIOS AGENDADOS -->
                                
                                <table class="table striped">
                                    <thead>
                                        <tr>
                                            <th bgcolor="#FDFDFD" align="left">Nome</th>
                                            <th bgcolor="#FDFDFD" align="left">Profissional</th>
                                            <th bgcolor="#FDFDFD" align="left">Data</th>
                                            <th bgcolor="#FDFDFD" align="left">Horário</th>
                                            <!-- <th bgcolor="#FDFDFD" align="left">Ação</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? while ($linhasbuscapac = mysql_fetch_array($resultadobuscapac, MYSQL_NUM)){ ?>
                                        <tr>
                                            <td><? echo utf8_encode($linhasbuscapac[0]);?></td>
                                            <?
	                                            //Busca o nome dos profissionais
	                                            $sqlp = "SELECT nome FROM profissionais WHERE id = '$linhasbuscapac[1]'";
	                                            $resultadop = mysql_query($sqlp);
	                                            $resultp = mysql_fetch_array($resultadop);
                                            ?>
                                            <td><? echo $resultp[0];?></td>
                                            <? $datan = implode("/", array_reverse(explode("-", $linhasbuscapac[2]))); ?>
                                            <td><? echo $datan;?></td>
                                            <td><? echo $linhasbuscapac[3];?></td>
                                            <!-- <td>
                                                <a class="button image-button primary image-left" name="editar" href="editaragenda.php?id=<? echo $linhash[2];?>&data=<? echo $data;?>&profissional=<? echo $profissional;?>"><i class="icon-pencil on-left" style="top: -3px; left: 7px"></i>Editar</a>
                                                &nbsp;&nbsp;
                                                <a class="button image-button danger image-left" name="excluir" href="excluiragendabd.php?id=<? echo $linhash[2];?>&data=<? echo $data;?>&profissional=<? echo $profissional;?>"><i class="icon-cancel-2 on-left" style="top: -3px; left: 7px"></i>Excluir</a>
                                            </td> -->
                                        </tr>
                                        <?};?>
                                    </tbody>
                                </table><br />
                                
                                <!-- FIM DA TABELA HORÁRIOS AGENDADOS -->
                                <!-- <center>
                                    <a class="button image-button primary image-left" name="voltar" href="agenda.php"><i class="icon-arrow-left on-left" style="top: -3px; left: 7px"></i>Voltar</a>
                                    <a class="button image-button primary image-left" name="imprimir" href="imprimiragenda.php?data=<? echo $data;?>&profissional=<? echo $profissional;?>"><i class="icon-printer on-left" style="top: -3px; left: 7px"></i>Imprimir</a>
                                    <a class="button image-button primary image-left" name="novo" href="novoagenda.php?data=<? echo $data;?>&profissional=<? echo $profissional;?>"><i class="icon-new on-left" style="top: -3px; left: 7px"></i>Novo</a>
                                </center> -->
                                    
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