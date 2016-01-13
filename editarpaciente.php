<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<!-- REALIZA A CONSULTA NO DB DA INFORMACAO ENVIADA -->
<?

if (isset($_GET["codigo"])){
    $codigo = $_GET["codigo"];
}else {if (isset($_POST["codigo"])){
    $codigo = $_POST["codigo"];
}};

$sqleditpac = "SELECT data, endereco, cep, bairro, telefone, celular, cidade, estado, nome, id, convenio, profissao, email FROM pacientes WHERE codigo = '20150910259299'";
$resultadoeditpac = mysql_query($sqleditpac);
$resulteditpac = mysql_fetch_array($resultadoeditpac);
$linhaseditpac = mysql_num_rows($resultadoeditpac);

if ($linhaseditpac > 0) { //Verifica se encontrou algum paciente

$datan = implode("/", array_reverse(explode("-", $resulteditpac[0])));

?>

<script src="js/cep.js" type="text/javascript"></script> <!-- SCRIPT CEP -->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->

    <script>
        $(function() {
            jQuery(function($){
                $("#tel").mask("(99) 9999-9999");
                $("#cel").mask("(99) 99999-9999");
                $("#cep").mask("99999-999");
                $("#data").mask("99/99/9999");
            });
        });
        
        //function zerar() {
            //document.getElementById("divcpf").className = "input-control text";
            //document.getElementById("divnome").className = "input-control text";
            //document.getElementById("editarpaciente").reset();
            
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
                <form method="POST" onsubmit="return valida(this);" action="editarpacientebd.php" name="editarpaciente" id="editarpaciente">
                <input type="hidden" id="id" name="id" value="<? echo $resulteditpac[9]?>">
                <div class="editpaciente">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                        <li><a href="#_page_2">Endereço</a></li>
                        <li><a href="#_page_3">Outros</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Código</label>
                            <div class="input-control text size4" id="cod" data-role="input-control">
                                <input type="text" id="codigo" readonly="readonly" name="codigo" value="<?echo $codigo;?>">
                            </div>
                            <label>Nome</label>
                            <div class="input-control text" id="divnome" data-role="input-control">
                                <input type="text" id="nome" name="nome" value="<? echo utf8_encode($resulteditpac[8])?>" placeholder="Nome do Paciente">
                            </div>
                            <table><tr>
                            <!-- <td bgcolor="#FDFDFD">
                                <label>CPF</label>
                                <div class="input-control text size2" id="divcpf" data-role="input-control">
                                    <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="Informe o CPF">
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td> -->
                            <td bgcolor="#FDFDFD">
                                <label>Data Nasc.</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="data" name="data" value="<? echo $datan;?>" placeholder="Data">
                                </div></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                <label>Convênio</label>
                                <div class="input-control text size4" data-role="input-control">
                                    <input type="text" id="convenio" name="convenio" value="<? echo utf8_encode($resulteditpac[10])?>" placeholder="Convênio">
                                </div></td>
                            </tr></table>
                            <table><tr>
                                <td bgcolor="#FDFDFD">
                                    <label>Telefone</label>
                                    <div class="input-control text size3" data-role="input-control">
                                        <input type="text" id="tel" name="tel" value="<? echo utf8_encode($resulteditpac[4])?>" placeholder="Telefone">
                                    </div>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                    <label>Celular</label>
                                    <div class="input-control text size3" data-role="input-control">
                                        <input type="text" id="cel" name="cel" value="<? echo utf8_encode($resulteditpac[5])?>" placeholder="Celular">
                                    </div>
                                </td> 
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
                        <div class="frame" id="_page_2">
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>CEP</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="cep" name="cep" maxlength="9" value="<? echo utf8_encode($resulteditpac[2])?>" placeholder="Informe o CEP">
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Bairro</label>
                                <div class="input-control text size4" data-role="input-control">
                                    <input type="text" id="bairro" name="bairro" value="<? echo utf8_encode($resulteditpac[3])?>" placeholder="Bairro">
                                </div></td>
                            </tr></table>
                            <label>Rua</label>
                            <div class="input-control text size6" data-role="input-control">
                                <input type="text" id="rua" name="rua" value="<? echo utf8_encode($resulteditpac[1])?>" placeholder="Nome da Rua / Logradouro">
                            </div>
                            <table><tr>
                                <td bgcolor="#FDFDFD">
                                    <label>Cidade</label>
                                    <div class="input-control text size5" data-role="input-control">
                                        <input type="text" id="cidade" name="cidade" value="<? echo utf8_encode($resulteditpac[6])?>" placeholder="Cidade">
                                    </div>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                    <label>UF</label>
                                    <div class="input-control text size1" data-role="input-control">
                                        <input type="text" id="estado" name="estado" value="<? echo utf8_encode($resulteditpac[7])?>" placeholder="Estado">
                                    </div>
                                </td> 
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
                        <div class="frame" id="_page_3">
                            <table><tr>
                            <!-- <td bgcolor="#FDFDFD">
                                <label>CEP</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="cep" name="cep" maxlength="9" placeholder="Informe o CEP">
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td> -->
                            <td bgcolor="#FDFDFD">
                                <label>E-Mail</label>
                                <div class="input-control text size4" data-role="input-control">
                                    <input type="text" id="email" name="email" value="<? echo utf8_encode($resulteditpac[12])?>" placeholder="E-Mail">
                                </div></td>
                            </tr></table>
                            <label>Profissão</label>
                            <div class="input-control text size6" data-role="input-control">
                                <input type="text" id="profissao" name="profissao" value="<? echo utf8_encode($resulteditpac[11])?>" placeholder="Profissão">
                            </div>
                            <br /><br />
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
                
                <div class="editpaciente">
                    <div class="panel">
                        <div class="panel-header bg-darkRed fg-white">
                            <center>Erro ao buscar paciente!!!</center>
                        </div>
                        <div class="panel-content">
                            Não foi possível localizar o paciente.
                            Codigo = <? echo $codigo;?>
                            Linhas = <? echo $linhaseditpac;?>
                        </div>
                    </div><br />
                    <center>
                        <a class="button bg-darkBlue fg-white" href="buscarpaciente.php"><i class="icon-undo on-left-more"></i>Voltar</a>
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