<!-- INCLUI O INICIO DO ARQUIVO -->
<? include ("header.php"); ?>

<? $login = $_SESSION['login']; ?>

<style type="text/css">
<!--
	body {
		background-image: url("imagens/Wallpaper2.jpg");
		background-repeat: no-repeat;
		background-position: 500px 370px;
		/*width: 40px;*/
	}
-->
</style>

<!-- INICIO DO ARQUIVO -->
<body class="metro">
    
    <br>
    
    <!--<input type="image" src="imagens/photo1.jpg" />-->
    <img src="imagens/photo1.jpg" />
    
    <br><br><br>
    
    <center><img src="imagens/principal1.png" /></center>
    <br><br>
    
    <div class="grid">
        <div class="row">
    
            <? include ("menu.php"); ?>
            
            <br>
            <div class="span2"></div>
            <!-- <img src="imagens/Wallpaper.jpg" width="700" /> -->
           
            
        </div>
    </div>

</body>
<!-- FIM DO ARQUIVO -->

<!-- INCLUI O FIM DO ARQUIVO -->
<? include ("footer.php"); ?>