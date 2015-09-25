<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<script src="js/cep.js" type="text/javascript"></script> <!-- SCRIPT CEP -->
<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->

    <script>
        $(function() {
            jQuery(function($){
                $("#tel").mask("(99) 9999-9999");
                $("#cel").mask("(99) 99999-9999");
                $("#telcom").mask("(99) 99999-9999");
                $("#cep").mask("99999-999");
                $("#cnpj").mask("99.999.999/9999-99");
            });
        });
        
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
            
            var str = document.getElementById("cnpj").value;
            
            if (form.cnpj.value=="") {
                alert("CNPJ não informado!!");
                document.getElementById("divcnpj").className = "input-control text error-state";
                form.cnpj.focus();
                return false;
            } else {
                str = str.replace('.','');
                str = str.replace('.','');
                str = str.replace('.','');
                str = str.replace('-','');
                str = str.replace('/','');
                cnpj = str;
                var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
                digitos_iguais = 1;
                if (cnpj.length < 14 && cnpj.length < 15) {
                    alert("CNPJ invalido!!");
                    document.getElementById("divcnpj").className = "input-control text error-state";
                    form.cnpj.focus();
                    return false;
                }
                for (i = 0; i < cnpj.length - 1; i++)
                    if (cnpj.charAt(i) != cnpj.charAt(i + 1))
                    {
                        digitos_iguais = 0;
                        document.getElementById("divcnpj").className = "input-control text error-state";
                        form.cnpj.focus();
                        break;
                    }
                if (!digitos_iguais)
                {
                    tamanho = cnpj.length - 2
                    numeros = cnpj.substring(0,tamanho);
                    digitos = cnpj.substring(tamanho);
                    soma = 0;
                    pos = tamanho - 7;
                    for (i = tamanho; i >= 1; i--)
                    {
                        soma += numeros.charAt(tamanho - i) * pos--;
                        if (pos < 2)
                            pos = 9;
                    }
                    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                    if (resultado != digitos.charAt(0)) {
                        alert("CNPJ invalido!!");
                        document.getElementById("divcnpj").className = "input-control text error-state";
                        form.cnpj.focus();
                        return false;
                    }
                    tamanho = tamanho + 1;
                    numeros = cnpj.substring(0,tamanho);
                    soma = 0;
                    pos = tamanho - 7;
                    for (i = tamanho; i >= 1; i--)
                    {
                        soma += numeros.charAt(tamanho - i) * pos--;
                        if (pos < 2)
                            pos = 9;
                    }
                    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                    if (resultado != digitos.charAt(1)) {
                        alert("CNPJ invalido!!");
                        document.getElementById("divcnpj").className = "input-control text error-state";
                        form.cnpj.focus();
                        return false;
                    }
                    document.getElementById("divcnpj").className = "input-control text";
                    return true;
                }
                else {
                    alert("CNPJ invalido!!");
                    document.getElementById("divcnpj").className = "input-control text error-state";
                    form.cnpj.focus();
                    return false;
                }
                
            }
       };
        
    </script>
    
<!-- BUSCA AS INFORMACOES DO CONVENIO -->
<?
if (isset($_GET["convenio"])){
    $convenio = utf8_decode($_GET["convenio"]);
}else {if (isset($_POST["convenio"])){
    $convenio = utf8_decode($_POST["convenio"]);
}};

$sql = "SELECT nome, contato, telcom, cnpj, endereco, cep, bairro, telefone, celular, cidade, estado, id FROM convenios WHERE id = '$convenio'";
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
                <form method="POST" onsubmit="return valida(this);" action="excluirconveniobd.php" name="excluirconvenio" id="excluirconvenio">
                    <input type="hidden" name="id" value="<?echo $result[11]?>">
                <div class="excluiconvenio">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Informações</a></li>
                        <li><a href="#_page_2">Endereço</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Nome</label>
                            <div class="input-control text" id="divnome" data-role="input-control">
                                <input type="text" id="nome" name="nome" disabled="disabled" value="<?echo utf8_encode($result[0])?>" placeholder="Nome do Convênio">
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>CNPJ</label>
                                <div class="input-control text size3" id="divcnpj" data-role="input-control">
                                    <input type="text" id="cnpj" name="cnpj" maxlength="14" disabled="disabled" value="<?echo utf8_encode($result[3])?>" placeholder="Informe o CNPJ">
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Contato</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="contato" name="contato" disabled="disabled" value="<?echo utf8_encode($result[1])?>" placeholder="Contato">
                                </div></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                <label>Comercial</label>
                                <div class="input-control text size3" data-role="input-control">
                                    <input type="text" id="telcom" name="telcom" disabled="disabled" value="<?echo utf8_encode($result[2])?>" placeholder="Comercial">
                                </div></td>
                            </tr></table>
                            <table><tr>
                                <td bgcolor="#FDFDFD">
                                    <label>Telefone</label>
                                    <div class="input-control text size3" data-role="input-control">
                                        <input type="text" id="tel" name="tel" disabled="disabled" value="<?echo utf8_encode($result[7])?>" placeholder="Telefone">
                                    </div>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                    <label>Celular</label>
                                    <div class="input-control text size3" data-role="input-control">
                                        <input type="text" id="cel" name="cel" disabled="disabled" value="<?echo utf8_encode($result[8])?>" placeholder="Celular">
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
                                    <input type="text" id="cep" name="cep" maxlength="9" disabled="disabled" value="<?echo utf8_encode($result[5])?>" placeholder="Informe o CEP">
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Bairro</label>
                                <div class="input-control text size4" data-role="input-control">
                                    <input type="text" id="bairro" name="bairro" disabled="disabled" value="<?echo utf8_encode($result[6])?>" placeholder="Bairro">
                                </div></td>
                            </tr></table>
                            <label>Rua</label>
                            <div class="input-control text size6" data-role="input-control">
                                <input type="text" id="rua" name="rua" disabled="disabled" value="<?echo utf8_encode($result[4])?>" placeholder="Nome da Rua / Logradouro">
                            </div>
                            <table><tr>
                                <td bgcolor="#FDFDFD">
                                    <label>Cidade</label>
                                    <div class="input-control text size5" data-role="input-control">
                                        <input type="text" id="cidade" name="cidade" disabled="disabled" value="<?echo utf8_encode($result[9])?>" placeholder="Cidade">
                                    </div>
                                </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                <td bgcolor="#FDFDFD">
                                    <label>UF</label>
                                    <div class="input-control text size1" data-role="input-control">
                                        <input type="text" id="estado" name="estado" disabled="disabled" value="<?echo utf8_encode($result[10])?>" placeholder="Estado">
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