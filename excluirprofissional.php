<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<script src="js/cep.js" type="text/javascript"></script> <!-- SCRIPT CEP -->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->

    <script>
                
        //function zerar() {
          //  document.getElementById("divcpf").className = "input-control text";
          //  document.getElementById("divnome").className = "input-control text";
          //  document.getElementById("salvapaciente").reset();
            
        //}
        
        function valida(form) {
            if (confirm("Você tem certeza que deseja excluir o profissional?") == true) {
                return true;
            }
            else {
                return false;
            }  
       };
        
    </script>
    
<!-- BUSCA AS INFORMACOES DO PROFISSIONAL -->
<?
if (isset($_GET["profissional"])){
    $profissional = utf8_decode($_GET["profissional"]);
}else {if (isset($_POST["profissional"])){
    $profissional = utf8_decode($_POST["profissional"]);
}};

$sql = "SELECT nome, crmcro, id, tipo FROM profissionais WHERE id = '$profissional'";
$resultado = mysql_query($sql);
$result = mysql_fetch_array($resultado);
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
                <form method="POST" onsubmit="return valida(this);" action="excluirprofissionalbd.php" name="salvaprofissional" id="salvaprofissional">
                <input type="hidden" name="id" value="<?echo $result[2]?>">
                <div class="editaprofissional">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Nome</label>
                            <div class="input-control text" id="divnome" data-role="input-control">
                                <input type="text" id="nome" name="nome" value="<?echo utf8_encode($result[0])?>" placeholder="Nome do Profissional" disabled>
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Tipo</label>
                                <div class="input-control select">
                                    <select name="tipo" disabled="disabled">
                                        <option value="<?echo $result[3]?>"><?echo $result[3]?></option>
                                        <option value="">----</option>
                                        <option value="CRM">CRM</option>
                                        <option value="CRO">CRO</option>
                                    </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Inscrição</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="crmcro" name="crmcro" value="<?echo $result[1]?>" placeholder="Insc. do Conselho" disabled>
                                </div></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            </tr></table><br />
                            <center>
                                
                                <button type="submit" class="image-button danger image-left">
                                    Excluir
                                    <i class="icon-cancel-2 on-left" style="top: -3px; left: 7px">
                                    </i>
                                </button>
                                
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