<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<!-- REALIZA A CONSULTA NO DB DA INFORMACAO ENVIADA -->
<?

if (isset($_GET["cpf"])){
    $cpf = utf8_decode($_GET["cpf"]);
}else {if (isset($_POST["cpf"])){
    $cpf = utf8_decode($_POST["cpf"]);
}};

$sql = "SELECT matricula, data, endereco, cep, bairro, telefone, celular, cidade, estado, nome, id FROM pacientes WHERE cpf = '$cpf'";
$resultado = mysql_query($sql);
$result = mysql_fetch_array($resultado);
$linhas = mysql_num_rows($resultado);

if ($linhas > 0) { //Verifica se encontrou algum paciente

$datan = implode("/", array_reverse(explode("-", $result[1])));

?>

<script src="js/cep.js" type="text/javascript"></script> <!-- SCRIPT CEP -->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->

    <script>
        $(function() {
            jQuery(function($){
                $("#tel").mask("(99) 9999-9999");
                $("#cel").mask("(99) 99999-9999");
                $("#cep").mask("99999-999");
                $("#cpf").mask("999.999.999-99");
                $("#data").mask("99/99/9999");
            });
        });
        function valida(form) {
            if (confirm("Você tem certeza que deseja excluir o paciente?") == true) {
                return true;
            }
            else {
                return false;
            }  
       };
        
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
                <form method="POST" onsubmit="return valida(this);" action="excluirpacientebd.php" name="excluirpaciente">
                <input type="hidden" id="id" name="id" value="<? echo $result[10]?>">
                <div class="excluipaciente">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                        <li><a href="#_page_2">Endereço</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Nome</label>
                            <div class="input-control text" id="divnome" data-role="input-control">
                                <input type="text" id="nome" name="nome" value="<? echo utf8_encode($result[9])?>" placeholder="Nome do Paciente" disabled>
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>CPF</label>
                                <div class="input-control text size2" id="divcpf" data-role="input-control">
                                    <input type="text" id="cpf" name="cpf" maxlength="14" value="<? echo $cpf?>" placeholder="Informe o CPF" disabled>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Data Nasc.</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="data" name="data" value="<? echo $datan?>" placeholder="Data" disabled>
                                </div></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                <label>Matricula</label>
                                <div class="input-control text size3" data-role="input-control">
                                    <input type="text" id="matricula" name="matricula" value="<? echo $result[0]?>" placeholder="Matricula" disabled>
                                </div></td>
                            </tr></table>
                            <table><tr>
                                <td bgcolor="#FDFDFD">
                                    <label>Telefone</label>
                                    <div class="input-control text size3" data-role="input-control">
                                        <input type="text" id="tel" name="tel" value="<? echo $result[5]?>" placeholder="Telefone" disabled>
                                    </div>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                    <label>Celular</label>
                                    <div class="input-control text size3" data-role="input-control">
                                        <input type="text" id="cel" name="cel" value="<? echo $result[6]?>" placeholder="Celular" disabled>
                                    </div>
                                </td> 
                            </tr></table><br />
                            <center>
                                
                                <button type="submit" class="image-button danger image-left">
                                    Excluir
                                    <i class="icon-cancel-2 on-left" style="top: -3px; left: 7px">
                                    </i>
                                </button>
                                
                            </center>
                        </div>
                        <div class="frame" id="_page_2">
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>CEP</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="cep" name="cep" maxlength="9" value="<? echo $result[3]?>" placeholder="Informe o CEP" disabled>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Bairro</label>
                                <div class="input-control text size4" data-role="input-control">
                                    <input type="text" id="bairro" name="bairro" value="<? echo utf8_encode($result[4])?>" placeholder="Bairro" disabled>
                                </div></td>
                            </tr></table>
                            <label>Rua</label>
                            <div class="input-control text size6" data-role="input-control">
                                <input type="text" id="rua" name="rua" value="<? echo utf8_encode($result[2])?>" placeholder="Nome da Rua / Logradouro" disabled>
                            </div>
                            <table><tr>
                                <td bgcolor="#FDFDFD">
                                    <label>Cidade</label>
                                    <div class="input-control text size5" data-role="input-control">
                                        <input type="text" id="cidade" name="cidade" value="<? echo utf8_encode($result[7])?>" placeholder="Cidade" disabled>
                                    </div>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                    <label>UF</label>
                                    <div class="input-control text size1" data-role="input-control">
                                        <input type="text" id="estado" name="estado" value="<? echo $result[8]?>" placeholder="Estado" disabled>
                                    </div>
                                </td> 
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

<?
}
else { ?>
    
    <!-- INCLUI O INICIO DO ARQUIVO -->
    <? include ("header.php"); ?>

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
                
                <div class="excluipaciente">
                    <div class="panel">
                        <div class="panel-header bg-darkRed fg-white">
                            <center>Erro ao buscar paciente!!!</center>
                        </div>
                        <div class="panel-content">
                            Não foi possível localizar o paciente com o CPF informado. Favor verificar o CPF e tente novamente.
                        </div>
                    </div><br />
                    <center>
                        <a class="button bg-darkBlue fg-white" href="buscarpacienteexcluir.php"><i class="icon-undo on-left-more"></i>Voltar</a>
                    </center>
                </div>
                
            </div>
            <br>
            
        </div>
    </div>

</body>
<!-- FIM DO ARQUIVO -->

<!-- INCLUI O FIM DO ARQUIVO -->
<? include ("footer.php"); ?>
<?
}
?>