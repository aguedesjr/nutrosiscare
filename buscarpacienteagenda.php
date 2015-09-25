<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php"); 

//Busca o nome dos profissionais
$sqlp = "SELECT id, nome FROM profissionais";
$resultadop = mysql_query($sqlp);

?>

<script src="js/metro-calendar.js"></script>
<script src="js/metro-datepicker.js"></script>

<script>
$(function() {
    $("#datepicker").datepicker({
        //date: "2013-01-01", // set init date
        format: "dd/mm/yyyy", // set output format
        effect: "slide", // none, slide, fade
        position: "bottom", // top or bottom,
        locale: 'pt', // 'ru' or 'en', default is $.Metro.currentLocale (metro-locale.js)
    });
});
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
                <form method="POST" action="relatorioagenda.php" name="relatorioagenda">
                    <div class="agenda">
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
	                                            <div class="input-control text size5" data-role="input-control">
	                                                <input type="text" id="nome" name="nome" placeholder="Nome">
	                                            </div>
                                        	</td>
                                            <td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
                                            <td bgcolor="#FDFDFD">
			                                <label>Mês</label>
			                                <div class="input-control select">
			                                    <select name="mes" id="mes">
			                                        <option value="">SELECIONE</option>
			                                        <option value="01">Janeiro</option>
													<option value="02">Fevereiro</option>
													<option value="03">Março</option>
													<option value="04">Abril</option>
													<option value="05">Maio</option>
													<option value="06">Junho</option>
													<option value="07">Julho</option>
													<option value="08">Agosto</option>
													<option value="09">Setembro</option>
													<option value="10">Outubro</option>
													<option value="11">Novembro</option>
													<option value="12">Dezembro</option>
			                                    </select>
			                                </div><br /></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td><td bgcolor="#FDFDFD"></td>
			                                <td bgcolor="#FDFDFD">
			                                    <label>Ano</label>
			                                    <div class="input-control text" data-role="input-control">
			                                        <input type="text" id="ano" name="ano" placeholder="Ano">
			                                    </div>
			                                </td>
			                                <br />
                                        </tr>
                                    </table><br />
                                    <center>
                                        <button type="submit" class="image-button primary image-left">
                                            Procurar
                                            <i class="icon-search on-left" style="top: -3px; left: 7px">
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