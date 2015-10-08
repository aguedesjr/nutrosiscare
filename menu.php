		<? if ($_SESSION['perfil'] == "ADMIN" or $_SESSION["perfil"] == "USER"){?>
            <div class="span1"></div>
            <div class="span3">
                <nav class="sidebar light">
                    <ul>
                        <li class="title"><center>Menu</center></li>
                        <li class=""><a href="inicio.php"><i class="icon-home"></i>Inicio</a></li>
                        <li class="stick bg-red"><a class="dropdown-toggle" href="#"><i class="icon-calendar"></i>Agenda</a>
                        	<ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="agenda.php"><i class="icon-file"></i>Novo</a></li>
                                <li><a href="buscarpacienteagenda.php"><i class="icon-search"></i>Buscar</a></li>
                            </ul>
                        </li>
                        <li class="stick bg-orange"><a class="dropdown-toggle" href="#"><i class="icon-user-2"></i>Pacientes</a>
                            <ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="cadastrarpaciente.php"><i class="icon-file"></i>Cadastrar</a></li>
                                <li><a href="buscarpaciente.php"><i class="icon-pencil"></i>Editar</a></li>
                                <!-- <li><a href="buscarpacienteexcluir.php"><i class="icon-cancel-2"></i>Excluir</a></li>  -->
                            </ul>
                        </li>
                        <!-- <li class="stick bg-yellow">
                            <a class="dropdown-toggle" href="#"><i class="icon-user-3"></i>Profissional</a>
                            <ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="cadastrarprofissional.php"><i class="icon-file"></i>Cadastrar</a></li>
                                <li><a href="buscarprofissional.php"><i class="icon-pencil"></i>Editar</a></li>
                                <li><a href="buscarprofissionalexcluir.php"><i class="icon-cancel-2"></i>Excluir</a></li>
                            </ul>
                        </li>
                        <li class="stick bg-olive">
                            <a class="dropdown-toggle" href="#"><i class="icon-book"></i>Procedimentos</a>
                            <ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="cadastrarprocedimento.php"><i class="icon-file"></i>Cadastrar</a></li>
                                <li><a href="buscarprocedimentoeditar.php"><i class="icon-pencil"></i>Editar</a></li>
                                <li><a href="buscarprocedimentoexcluir.php"><i class="icon-cancel-2"></i>Excluir</a></li>
                                <li><a href="buscarprocedimento.php"><i class="icon-clipboard-2"></i>Listar</a></li>
                            </ul>
                        </li>
                        <li class="stick bg-green">
                            <a class="dropdown-toggle" href="#"><i class="icon-newspaper"></i>Convênios</a>
                            <ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="cadastrarconvenio.php"><i class="icon-file"></i>Cadastrar</a></li>
                                <li><a href="buscarconvenio.php"><i class="icon-pencil"></i>Editar</a></li>
                                <li><a href="buscarconvenioexcluir.php"><i class="icon-cancel-2"></i>Excluir</a></li>
                            </ul>
                        </li>
                        <li class="stick bg-blue">
                            <a class="dropdown-toggle" href="#"><i class="icon-cabinet"></i>Fichas Odonto</a>
                            <ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="fichaautorizacao.php"><i class="icon-foursquare"></i>Autorização</a></li>
                                <li><a href="fichabuscaprocedimento.php"><i class="icon-copy"></i>Procedimentos</a></li>
                                <li><a href="fichaprontuario.php"><i class="icon-folder-2"></i>Prontuário</a></li>
                            </ul>
                        </li> -->
                        <!-- SOMENTE ACESSO DO ADMIN -->
                        <? if ($_SESSION['perfil'] == "ADMIN"){?>
                        <li class="stick bg-yellow">
                            <a class="dropdown-toggle" href="#"><i class="icon-heart"></i>Fichas Médicas</a>
                            <ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="fichaanaminese.php"><i class="icon-stats"></i>Anaminese</a></li>
                                <!-- <li><a href="fichabuscaprocedimentomedicomedico.php"><i class="icon-copy"></i>Procedimentos</a></li>-->
                                <li><a href="fichareceituario.php"><i class="icon-clipboard-2"></i>Receituário</a></li>
                            </ul>
                        </li>
                        <!-- <li class="stick bg-steel">
                            <a class="dropdown-toggle" href="#"><i class="icon-stats-3"></i>Relatórios</a>
                            <ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="relatorioconvenio.php"><i class="icon-newspaper"></i>Convênio</a></li>
                                <li><a href="relatorioprofissional.php"><i class="icon-user-3"></i>Profissional</a></li>
                            </ul>
                        </li>-->
                        <!-- <li class="stick bg-brown">
                            <a class="dropdown-toggle" href="#"><i class="icon-key"></i>Usuários</a>
                            <ul class="dropdown-menu" data-role="dropdown">
                                <li><a href="cadastrarusuario.php"><i class="icon-file"></i>Cadastrar</a></li>
                                <!--<li><a href="editarusuario.php"><i class="icon-pencil"></i>Editar</a></li>
                                <li><a href="excluirusuario.php"><i class="icon-cancel-2"></i>Excluir</a></li>
                            </ul>
                        </li> -->  
                        <?};?>
                        <!-- FIM DO ACESSO DO ADMIN -->
                        
                        <li class=""><a href="logout.php"><i class="icon-exit"></i>Sair</a></li>
                    </ul>
                </nav>
            </div>
         <?};?>