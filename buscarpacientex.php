<!-- INCLUI O INICIO DO ARQUIVO -->
<? 

include ("header.php"); 

//Busca o nome dos pacientes
$sqlp = "SELECT nome, codigo FROM pacientes";
$resultadop = mysql_query($sqlp);

?>

<script src="js/jquery.dataTables.js"></script>

<script type="text/javascript">

	$(document).ready(function() {
	    $('#tabelapaciente').dataTable( {
		    "aaSorting" : [[1 , "asc"]], //organiza a tabela de acordo com a 2 coluna
		    "lengthMenu": [ 10 ],
			"language" : {
				"search":         "Procurar:",
				"info":           "Mostrando de _START_ a _END_ de _TOTAL_",
				"lengthMenu":     "Mostrando _MENU_ resultados",
				"thousands":      ".",
			    "paginate": {
			        "first":      "Primeira",
			        "last":       "Última",
			        "next":       "Próximo",
			        "previous":   "Anterior"
			    }
			}
	    } );
	} );

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
            	<div class="buscapaciente">
            	<div class="tab-control" data-role="tab-control">
            		<ul class="tabs">
                        <li class="active"><a href="#_page_1">Pacientes</a></li>
                    </ul>
                    <div class="frames">
                    	<div class="frame" id="_page_1">

								<table id="tabelapaciente" class="table striped dataTable">
							        <thead>
							            <tr>
							                <th class="text-left">Codigo</th>
							                <th class="text-left">Nome</th>
							            </tr>
							        </thead>
							        
							        <tbody>
							        
							        	<?
							        		while ($row = mysql_fetch_array($resultadop)) {
							        	?>
							        	<tr>
							        		<td><a  href="buscarpacienteexcluir.php?codigopac=<? echo $row[1];?>"><? echo $row[1];?></a></td>
							        		<td><? echo utf8_encode($row[0]);?></td>
							        	</tr>
							        	<?}?>
							        
							        </tbody>
							 
							        <tfoot>
							        </tfoot>
							    </table>
							
							</div>
					    </div>
					</div>
		    	</div>
		 	</div>
		</div>
    </div>

</body>
<!-- FIM DO ARQUIVO -->

<!-- INCLUI O FIM DO ARQUIVO -->
<? include ("footer.php"); ?>