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
    
    <center><img src="imagens/principal1.png" /></center>
    <br><br>
    
    <div class="grid">
        <div class="row">
    
            <? include ("menu.php"); ?>
            <div class="span1"></div>
            <div class="span10">
                <form method="POST" onsubmit="return valida(this);" action="cadastrarprofissionalbd.php" name="salvaprofissional" id="salvaprofissional">
                <div class="cadprofissional">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Dados Pessoais</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Nome</label>
                            <div class="input-control text" id="divnome" data-role="input-control">
                                <input type="text" id="nome" name="nome" placeholder="Nome do Profissional">
                            </div>
                            <table><tr>
                            <td bgcolor="#FDFDFD">
                                <label>Tipo</label>
                                <div class="input-control select">
                                    <select name="tipo">
                                        <option value=""></option>
                                        <option value="CRM">CRM</option>
                                        <option value="CRO">CRO</option>
                                    </select>
                                </div>
                            </td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                            <td bgcolor="#FDFDFD">
                                <label>Inscrição</label>
                                <div class="input-control text size2" data-role="input-control">
                                    <input type="text" id="crmcro" name="crmcro" placeholder="Insc. do Conselho">
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