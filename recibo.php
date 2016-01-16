<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php"); 

?>

<script src="js/jquery.maskedinput.js" type="text/javascript"></script> <!-- SCRIPT MASK -->
<<script src="js/jquery.maskMoney.min.js" type="text/javascript"></script> <!-- SCRIPT MONEY -->
<!--

//-->
</script>

<script>
        $(function() {
            jQuery(function($){
                $("#cpf").mask("999.999.999-99");
                $("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
            });
        });
        
        //function zerar() {
          //  document.getElementById("divcpf").className = "input-control text";
          //  document.getElementById("divnome").className = "input-control text";
          //  document.getElementById("salvapaciente").reset();
            
        //}
        
        function valida(form) {
            //if (form.nome.value=="") {
                //alert("Nome não informado!!");
                //document.getElementById("divnome").className = "input-control text error-state";
                //form.nome.focus();
                //return false;
            //}
            
            //if (form.nome.value!="") {
                //document.getElementById("divnome").className = "input-control text";
            //}
            
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
    
    <br><br><br>
    
    <center><img src="imagens/principal1.png" /></center>
    <br><br>
    
    <div class="grid">
        <div class="row">
    
            <? include ("menu.php"); ?>
            <div class="span1"></div>
            <div class="span10">
                <form method="POST" onsubmit="return valida(this);" action="gerarecibo.php" name="recibo">
                    <div class="recibo">
                        <div class="tab-control" data-role="tab-control">
                            <ul class="tabs">
                                <li class="active"><a href="#_page_1">Informações</a></li>
                            </ul>
                            <div class="frames">
                                <div class="frame" id="_page_1">
                                    <table>
                                    	<tr>
                                    		<td bgcolor="#FDFDFD">
                                    			<label>Nome</label>
					                            <div class="input-control text" id="divnome" data-role="input-control">
					                                <input type="text" id="nome" name="nome" placeholder="Nome do Paciente" autofocus required>
					                            </div>
                                    		</td>
                                    		<td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                    		<td bgcolor="#FDFDFD">
                                    			<label>CPF</label>
				                                <div class="input-control text size2" id="divcpf" data-role="input-control">
				                                    <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="Informe o CPF" required>
				                                </div>
                                    		</td>
                                    	</tr>
                                    </table><br>
                                    <table>
                                        <tr>
                                            <td bgcolor="#FDFDFD">
                                                <label>Data</label>
                                                <div class="input-control text" id="datepicker">
                                                    <input type="text" name="data" placeholder="Data">
                                                    <button class="btn-date"></button>
                                                </div>
                                            </td>
                                            <td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                            <td bgcolor="#FDFDFD">
                                                <label>Valor</label>
                                                <div class="input-control text" data-role="input-control">
				                                    <input type="text" id="valor" name="valor" placeholder="Informe o Valor" required>
				                                </div>
                                            </td>
                                        </tr>
                                    </table><br />
                                    <center>
                                        <button type="submit" class="image-button primary image-left">
                                            Imprimir
                                            <i class="icon-printer on-left" style="top: -3px; left: 7px">
                                            </i>
                                        </button>
                                    </center>
                                </div>
                            </div>    
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<!-- FIM DO ARQUIVO -->




<!-- INCLUI O FIM DO ARQUIVO -->
<? include ("footer.php"); ?>