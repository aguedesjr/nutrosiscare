
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
                <div class="">
                    <div class="panel">
                        <div class="panel-header bg-lightBlue fg-white">
                            <center>Usuário desconectado!!!</center>
                        </div>
                        <div class="panel-content">
                            <center>Feito logoff com sucesso....</center> 
                            <?
                              session_start();
                              //Codigo de logout
                              $_SESSION = array();
                              session_destroy(); //Encerra a sessao
                              unset($_SESSION[login]); //Limpa o login
                              //unset($_SESSION[perfil]); //Limpa o perfil
                              //unset($_SESSION[nome]); //Limpa a senha
                            ?>
                        </div>
                    </div><br />
                    <center>
                        <a class="button bg-darkBlue fg-white" href="index.php"><i class="icon-locked on-left" style="top: -3px; left: 7px"></i>Login</a>
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
