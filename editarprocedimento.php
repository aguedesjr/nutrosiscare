<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<script src="js/maskMoney.js" type="text/javascript"></script> <!-- SCRIPT MASK MONEY -->

    <script>
                
        //function zerar() {
          //  document.getElementById("divcpf").className = "input-control text";
          //  document.getElementById("divnome").className = "input-control text";
          //  document.getElementById("salvapaciente").reset();
            
        //}
        
        function valida(form) {
            if (form.nome.value=="") {
                alert("Nome não informado!!");
                document.getElementById("divnome").className = "input-control text error-state";
                form.nome.focus();
                return false;
            }
            
            if (form.nome.value!="") {
                document.getElementById("divnome").className = "input-control text";
            }
        };
        
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){    
            // Configuração para campos de Real.
            $("#valor").maskMoney({showSymbol:false, symbol:"R$", decimal:",", thousands:"."});
    });
    </script>

<?

if (isset($_GET["convenio"])){
  $convenio = utf8_decode($_GET["convenio"]);
}else {if (isset($_POST["convenio"])){
  $convenio = utf8_decode($_POST["convenio"]);
}};

if (isset($_GET["procedimento"])){
  $procedimento = utf8_decode($_GET["procedimento"]);
}else {if (isset($_POST["procedimento"])){
  $procedimento = utf8_decode($_POST["procedimento"]);
}};

$sqlc = "SELECT nome FROM convenios WHERE id = '$convenio'";
$resultadoc = mysql_query($sqlc);
$resultc = mysql_fetch_array($resultadoc);

$sql = "SELECT nome, id FROM convenios";
$resultado = mysql_query($sql);

$sqlp = "SELECT codigo, nome, grupo, valor FROM procedimentos WHERE id = '$procedimento'";
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
                <form method="POST" onsubmit="return valida(this);" action="editarprocedimentobd.php" name="editaprocedimento" id="editaprocedimento">
                <input type="hidden" name="id" value="<?echo $procedimento?>">
                <div class="editarprocedimento">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Informações</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Nome</label>
                            <div class="input-control text" id="divnome" data-role="input-control">
                                <input type="text" id="nome" name="nome" value="<? echo utf8_encode($resultp[1]);?>" placeholder="Nome do Procedimento">
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Grupo</label>
                                <div class="input-control select">
                                    <select name="grupo">
                                        <option value="<? echo utf8_encode($resultp[2]);?>"><? echo utf8_encode($resultp[2]);?></option>
                                        <option value="">---------</option>
                                        <option value="DIAGNÓSTICOS">DIAGNÓSTICOS</option>
                                        <option value="PROFILAXIA">PROFILAXIA</option>
                                        <option value="DENTÍSTICA">DENTÍSTICA</option>
                                        <option value="ENDODONTIA">ENDODONTIA</option>
                                        <option value="PERIODONTIA">PERIODONTIA</option>
                                        <option value="CIRURGIA">CIRURGIA</option>
                                        <option value="PRÓTESE">PRÓTESE</option>
                                        <option value="ORTODONTIA">ORTODONTIA</option>
                                        <option value="IMPLANTOLOGIA">IMPLANTOLOGIA</option>
                                    </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Convênio</label>
                                <div class="input-control select">
                                    <select name="convenio">
                                        <option value=<? echo $convenio; ?>><? echo utf8_encode($resultc[0]);?></option>
                                        <option value="">---------</option>
                                        <? while ($linhas = mysql_fetch_array($resultado, MYSQL_NUM)){ ?>
                                        <option value=<? echo $linhas[1];?>><? echo utf8_encode($linhas[0]);?></option>
                                        <?};?>
                                    </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Valor</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="valor" name="valor" value="<? echo utf8_encode($resultp[3]);?>" placeholder="Valor">
                                </div></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Código</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="codigo" name="codigo" value="<? echo utf8_encode($resultp[0]);?>" placeholder="Código do Proc.">
                                </div></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr></table><br />
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Salvar
                                    <i class="icon-floppy on-left" style="top: -3px; left: 7px">
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