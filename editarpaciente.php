<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<!-- REALIZA A CONSULTA NO DB DA INFORMACAO ENVIADA -->
<?

if (isset($_GET["codigo"])){
    $codigo = utf8_decode($_GET["codigo"]);
}else {if (isset($_POST["codigo"])){
    $codigo = utf8_decode($_POST["codigo"]);
}};

$sql = "SELECT matricula, data, endereco, cep, bairro, telefone, celular, cidade, estado, nome, id, cpf FROM pacientes WHERE codigo = '$codigo'";
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
            
            var str = document.getElementById("cpf").value;
            
            //if (form.cpf.value=="") {
                //alert("CPF não informado!!");
                //document.getElementById("divcpf").className = "input-control text error-state";
                //form.cpf.focus();
                //return false;
            //} 
            if (form.cpf.value!="") {
                str = str.replace('.','');
                str = str.replace('.','');
                str = str.replace('-','');
                cpf = str;
                var numeros, digitos, soma, i, resultado, digitos_iguais;
                digitos_iguais = 1;
                if (cpf.length < 11) {
                      alert("CPF invalido!!");
                      document.getElementById("divcpf").className = "input-control text error-state";
                      form.cpf.focus();
                      return false;
                }
                for (i = 0; i < cpf.length - 1; i++)
                      if (cpf.charAt(i) != cpf.charAt(i + 1))
                            {
                            digitos_iguais = 0;
                            //alert("CPF invalido!!");
                            document.getElementById("divcpf").className = "input-control text error-state";
                            form.cpf.focus();
                            break;
                            }
                if (!digitos_iguais)
                      {
                      numeros = cpf.substring(0,9);
                      digitos = cpf.substring(9);
                      soma = 0;
                      for (i = 10; i > 1; i--)
                            soma += numeros.charAt(10 - i) * i;
                      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                      if (resultado != digitos.charAt(0)) {
                            alert("CPF invalido!!");
                            document.getElementById("divcpf").className = "input-control text error-state";
                            form.cpf.focus();
                            return false;
                      }
                      numeros = cpf.substring(0,10);
                      soma = 0;
                      for (i = 11; i > 1; i--)
                            soma += numeros.charAt(11 - i) * i;
                      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                      if (resultado != digitos.charAt(1)){
                            alert("CPF invalido!!");
                            document.getElementById("divcpf").className = "input-control text error-state";
                            form.cpf.focus();
                            return false;
                        }
                      document.getElementById("divcpf").className = "input-control text";
                      return true;
                      }
                else {
                    alert("CPF invalido!!");
                    document.getElementById("divcpf").className = "input-control text error-state";
                    form.cpf.focus();
                    return false;
                }
                
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
                <form method="POST" onsubmit="return valida(this);" action="editarpacientebd.php" name="editarpaciente" id="editarpaciente">
                <input type="hidden" id="id" name="id" value="<? echo $result[10]?>">
                <div class="editpaciente">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                        <li><a href="#_page_2">Endereço</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Nome</label>
                            <div class="input-control text" id="divnome" data-role="input-control">
                                <input type="text" id="nome" name="nome" value="<? echo utf8_encode($result[9])?>" placeholder="Nome do Paciente">
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>CPF</label>
                                <div class="input-control text size2" id="divcpf" data-role="input-control">
                                    <input type="text" id="cpf" name="cpf" maxlength="14" value="<? echo $result[11]?>" placeholder="Informe o CPF">
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Data Nasc.</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="data" name="data" value="<? echo $datan?>" placeholder="Data">
                                </div></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                <label>Matricula</label>
                                <div class="input-control text size3" data-role="input-control">
                                    <input type="text" id="matricula" name="matricula" value="<? echo $result[0]?>" placeholder="Matricula">
                                </div></td>
                            </tr></table>
                            <table><tr>
                                <td bgcolor="#FDFDFD">
                                    <label>Telefone</label>
                                    <div class="input-control text size3" data-role="input-control">
                                        <input type="text" id="tel" name="tel" value="<? echo $result[5]?>" placeholder="Telefone">
                                    </div>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                    <label>Celular</label>
                                    <div class="input-control text size3" data-role="input-control">
                                        <input type="text" id="cel" name="cel" value="<? echo $result[6]?>" placeholder="Celular">
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
                                    <input type="text" id="cep" name="cep" maxlength="9" value="<? echo $result[3]?>" placeholder="Informe o CEP">
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Bairro</label>
                                <div class="input-control text size4" data-role="input-control">
                                    <input type="text" id="bairro" name="bairro" value="<? echo utf8_encode($result[4])?>" placeholder="Bairro">
                                </div></td>
                            </tr></table>
                            <label>Rua</label>
                            <div class="input-control text size6" data-role="input-control">
                                <input type="text" id="rua" name="rua" value="<? echo utf8_encode($result[2])?>" placeholder="Nome da Rua / Logradouro">
                            </div>
                            <table><tr>
                                <td bgcolor="#FDFDFD">
                                    <label>Cidade</label>
                                    <div class="input-control text size5" data-role="input-control">
                                        <input type="text" id="cidade" name="cidade" value="<? echo utf8_encode($result[7])?>" placeholder="Cidade">
                                    </div>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                    <label>UF</label>
                                    <div class="input-control text size1" data-role="input-control">
                                        <input type="text" id="estado" name="estado" value="<? echo $result[8]?>" placeholder="Estado">
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
                            Não foi possível localizar o paciente com o CPF informado. Favor verificar o CPF e tente novamente.
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