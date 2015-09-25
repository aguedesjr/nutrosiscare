<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

    <script>
                
        //function zerar() {
          //  document.getElementById("divcpf").className = "input-control text";
          //  document.getElementById("divnome").className = "input-control text";
          //  document.getElementById("salvapaciente").reset();
            
        //}
        
        function valida(form) {
            if (form.codigo.value=="") {
                alert("Código de Autorização não informado!!");
                document.getElementById("divcodigo").className = "input-control text size2 error-state";
                form.codigo.focus();
                return false;
            }
            
            if (form.codigo.value!="") {
                document.getElementById("divcodigo").className = "input-control text size2";
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
                <form method="POST" onsubmit="return valida(this);" action="fichaprocedimento.php" name="buscaautorizacao" id="buscaautorizacao">
                <div class="buscarficha">
                <div class="tab-control" data-role="tab-control">
                    <ul class="tabs">
                        <li class="active"><a href="#_page_1">Buscar Autorização</a></li>
                    </ul>
                    <div class="frames">
                        <div class="frame" id="_page_1">
                            <label>Autorização</label>
                            <div class="input-control text size2" id="divcodigo" data-role="input-control">
                                <input type="text" id="codigo" name="codigo" placeholder="Número">
                            </div>
                            
                            <center>
                                
                                <button type="submit" class="image-button primary image-left">
                                    Buscar
                                    <i class="icon-search on-left" style="top: -3px; left: 7px">
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