<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Softpool</title>

	<!-- Estilos CSS próprios-->

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_activas.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_detalhesboleia.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_criarboleia.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_filtros.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_criarviatura.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_criarencomenda.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_mensagens.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_caixamensagens.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_qrcode.css"  />

	<!-- Estilos CSS importados -->

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css/fontawesome-all.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css/slider/nouislider.min.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css/datepicker/tempusdominus-bootstrap-4.min.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css/titatoggle/titatoggle-dist-min.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css/jquery-ui.min.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css/datatables/jquery.dataTables.css"  />
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/datatables/scroller.jqueryui.css"  /> -->


</head>

<body>
	<header>

		<!-- Espaço sem nada até à identificação do site -->

		<section class="topo"></section>


		<!-- Barra com o logotipo da softpool -->

		<section>
			<div class="softpool">
				<div class="downbotao" id="download_appp"><img src="<?php echo base_url()?>assets/imagens/download.svg"></div>
				<div id="funcaodechat" class="chatbotao">
					<img src="<?php echo base_url()?>assets/imagens/chatting.svg">
				</div>
				<a id="logar_off" href="<?php echo base_url()?>index.php/activas/logoff">
				<div class="logoff_texto">Sair</div>
				<div class="logoff">
					<img src="<?php echo base_url()?>assets/imagens/off-button.svg">
				</div>
				</a>
				

				
			</div>
			<div id="voltarinicio" class="softpoolimg"><img src="<?php echo base_url()?>assets/imagens/softpool.png" alt="Ir para Home"></div> 

		</section>

		<!-- Espaço que separa o cabeçalho do corpo -->

		<section class="espaco">


		</section>




	</header>

	<!-- Formulario de pesquisa -->

	<div class="search">
		<div class="pesquisa">
			<?php echo validation_errors();
			if(isset($error)){print $error;}?>    

			<form id="formulario" action="<?php echo base_url()?>index.php/activas/pool" method="post">
				<div class="form-inline">
					<div class="form-group posic">
						<input type="text" class="form-control" id="_part" name="_partida" placeholder="Partida...">
					</div>
					<div class="posic">
						<img id="volswap" class="volante" src="<?php echo base_url()?>assets/imagens/volante.png">
					</div>
					<div class="form-group posic">
						<input type="text" class="form-control" id="_dest" name="_destino" placeholder="Destino...">
					</div>
					<div class="form-group posic">
						<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
							<input type="text" name="_horario" placeholder="Data..." class="form-control datetimepicker-input" data-target="#datetimepicker1" />
							<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
						</div>
					</div>


					<div class="posic">
						<a href="#" onClick="document.getElementById('formulario').submit();"><img class="lupa" src="<?php echo base_url()?>assets/imagens/lupa.png"></a>
					</div>
					<div class="posic carro">
						<a href="#criarBoleia" class="posic" data-toggle="modal">
							<img src="<?php echo base_url()?>assets/imagens/Group81.png">
						</a>
					</div>

				</div>
			</form>
		</div>
	</div>

	<?php if(empty($pesquisa)):?>
		<div class="container margemsuperior">

			<?php if(isset($dadosprocessados['erros']))
			print_r($dadosprocessados['erros']) ?>


			<!-- Boleias a partir do utilizador -->

			<div class="row">
				<div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 sem_relativo">
					<div class="tituloverde">
						Boleias a sair de <?php echo $_SESSION["local"];?>
						<div id="filt_local" class="filt">
							<img src="<?php echo base_url()?>assets/imagens/sliders.svg">
						</div>
					</div>
					
					<div class="brancocomsombra">
						<table id="Asairde" class="hover largura_tabela" style="width:100%">
							<thead>
								<tr>
									<th>Datapartida</th>
									<th>Relogio</th>
									<th>Horapartida</th>
									<th>Setas</th>
									<th>Horachegada</th>
									<th>Placeholder</th>
									<th>Destino</th>
									<th>Foto</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list->result() as $row):?>
									<tr class="bleia" id="<?php echo $row->IDBOLEIA?>">
										<td class="primeira" data-order="<?php echo $row->DATA_DE_PARTIDA?>"><div><?php echo MesDiaPortugues($row->DATA_DE_PARTIDA)?></div></td>	
										<td><div class="watch"><img src="<?php echo base_url()?>assets/imagens/relogio.svg"></div></td>
										<td><?php echo date_format(date_create($row->DATA_DE_PARTIDA),'H:i')?></td>
										<td><div class="watch"><img src="<?php echo base_url()?>assets/imagens/setasdireita.svg"></div></td>
										<td><?php echo date_format(date_create($row->DATA_DE_CHEGADA), 'H:i')?></td>
										<td><div class="watch"><img src="<?php echo base_url()?>assets/imagens/placeholder.svg"></div></td>
										<td><?php echo $row->DESTINO?></td>
										<td><div class="watch"><img src="<?php echo base_url()?>assets/fotos/<?php echo $row->FOTO?>" title="<?php echo $row->NOME?>"></div></td>
										<td><div class="todoestado watch" id="<?php echo $row->ESTADO?>"><img src="<?php echo base_url()?>assets/imagens/estado<?php echo $row->ESTADO?>.svg"></div></td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- Boleias activas em que o utilizador se encontra -->

				<div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 sem_relativo">
					
                    <div class="tituloverde">Boleias Activas
<div id="filt_activas" class="filt">                             <img
src="<?php echo base_url()?>assets/imagens/sliders.svg">
</div>                     </div>                     <div
class="brancocomsombra">                         <table id="Asairporuser"
class="hover largura_tabela" style="width:100%">
<thead>                                 <tr>
<th>Datapartida</th>                                     <th>Relogio</th>
<th>Horapartida</th>                                     <th>Setas</th>
<th>Horachegada</th>                                     <th>Origem</th>
<th>Placeholder</th>                                     <th>Destino</th>
<th>Foto</th>                                     <th>Estado</th>
</tr>                             </thead>                             <tbody>
<?php foreach($user->result() as $row):?>
<tr class="bleia" id="<?php echo $row->IDBOLEIA?>">
<td class="primeira" data-order="<?php echo
$row->DATA_DE_PARTIDA?>"><div><?php echo
MesDiaPortugues($row->DATA_DE_PARTIDA)?></div></td>
<td><div class="watch"><img src="<?php echo
base_url()?>assets/imagens/relogio.svg"></div></td>
<td><?php echo date_format(date_create($row->DATA_DE_PARTIDA),'H:i')?></td>
<td><div class="watch"><img src="<?php echo
base_url()?>assets/imagens/setasdireita.svg"></div></td>
<td><?php echo date_format(date_create($row->DATA_DE_CHEGADA), 'H:i')?></td>
<td><?php echo $row->ORIGEM?></td>
<td><div class="watch"><img src="<?php echo
base_url()?>assets/imagens/placeholder.svg"></div></td>
<td><?php echo $row->DESTINO?></td>
<td><div class="watch"><img src="<?php echo base_url()?>assets/fotos/<?php
echo $row->FOTO?>" title="<?php echo $row->NOME?>"></div></td>
<td><div class="todoestado watch" id="<?php echo $row->ESTADO?>"><img
src="<?php echo base_url()?>assets/imagens/estado<?php echo
$row->ESTADO?>.svg"></div></td>                                     </tr>
<?php endforeach;?>                             </tbody>
</table>                     </div>                 </div>             </div>
</div>




		<?php else:?>

			<!-- Resultados de pesquisa. Só aparece caso haja variáveis post. -->

			<div class="container margemsuperior">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 sem_relativo">
						<div class="tituloverde">
							Boleias de acordo com a pesquisa
							<div id="filt_pesquisa" class="filt">
								<img src="<?php echo base_url()?>assets/imagens/sliders.svg">
							</div>
						</div>
						

						<div class="brancocomsombra">
						<table id="results_pesquisa" class="hover largura_tabela" style="width:100%">
							<thead>
								<tr>
									<th>Datapartida</th>
									<th>Relogio</th>
									<th>Horapartida</th>
									<th>Setas</th>
									<th>Horachegada</th>
									<th>Origem</th>
									<th>Placeholder</th>
									<th>Destino</th>
									<th>Foto</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($pesquisa as $boleias):?>
									<tr class="bleia" id="<?php echo $boleias->IDBOLEIA?>">
										<td class="primeira" data-order="<?php echo $boleias->DATA_DE_PARTIDA?>"><div><?php echo MesDiaPortugues($boleias->DATA_DE_PARTIDA);  ?></div></td>
										<td><div class="watch"><img src="<?php echo base_url()?>assets/imagens/relogio.svg"></div></td>
										<td><?php echo date_format(date_create($boleias->DATA_DE_PARTIDA), 'H:i'); ?></td>
										<td><div class="watch"><img src="<?php echo base_url()?>assets/imagens/setasdireita.svg"></div></td>
										<td><?php echo date_format(date_create($boleias->DATA_DE_CHEGADA), 'H:i'); ?></td>
										<td><?php echo $boleias->ORIGEM; ?></td>
										<td><div class="watch"><img src="<?php echo base_url()?>assets/imagens/placeholder.svg"></div></td>
										<td><?php echo $boleias->DESTINO; ?></td>
										<td><div class="watch"><img src="<?php echo base_url().'assets/fotos/'.$boleias->FOTO?>"></div></td>
										<td><?php echo $boleias->ESTADO; ?></td>
									</tr>

								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					</div>

				</div>
			</div>

		<?php endif; ?>

		

		<!-- Modal para criar boleia -->

		<div class="modal fade" id="criarBoleia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog cb_larguracriarboleiaheader ligarelmentos" role="document">
				
				<div class="cb_total">
					<form action="<?php echo base_url()?>index.php/criar/NewRide", id="formulariocriar" method="post">
						<div class="cb_header">
							<div class="cb_headertexto">Criar boleia</div>
						</div>

						<div class="cb_loc_e_data">
							<input class="cb_escondido" id="iddapartida" type="text" name="cb_obteridpartida" form="formulariocriar">
							<input class="cb_escondido" id="iddodestino" type="text" name="cb_obteriddestino" form="formulariocriar">
							<div class="cb_phgrande"><img src="<?php echo base_url()?>assets/imagens/inserirboleia-local.svg"></div>
							<div class="cb_partida">
								<input type="text" id="cbidpartida" name="cb_obterpartida" placeholder="Partida..." form="formulariocriar" required>
							</div>
							<div class="cb_volante">
								<img src="<?php echo base_url()?>assets/imagens/inserirboleia-volante.svg">
							</div>
							<div class="cb_destino">
								<input type="text" id="cbiddestino" name="cb_obterdestino" placeholder="Destino..." form="formulariocriar" required>
							</div>
							<div class="cb_calendario">
								<div class="cb_calendario_img"><img src="<?php echo base_url()?>assets/imagens/inserirboleia-cal.svg"></div>
								<div class="cb_calendario_txt">
									<input type="text" class="datetimepicker-input" id="datetimepicker3" data-toggle="datetimepicker" name="cb_obterdata" data-target="#datetimepicker3" placeholder="Data..." form="formulariocriar" required/>
								</div>
							</div>
						</div>

						<div class="cb_horas">
							<div class="cb_horaspartida">
								<div class="cb_horas_txt">Hora de Saída</div>
								<div id="sliderpartida" class="cb_sliderescolhahoras"></div>
							</div>
							<div class="cb_horasdestino">
								<div class="cb_horas_txt">Hora de Chegada</div>
								<div id="sliderdestino" class="cb_sliderescolhahoras"></div>

							</div>
							<div class="cb_objectivo">
								<div class="cb_objectivo_txt">Objectivo pessoal?</div>
								<div class="cb_toggle checkbox checkbox-slider--b-flat">
									<label>
										<input name="cb_obterobjectpessoal" type="checkbox" form="formulariocriar" value="true"><span></span>
									</label>
								</div>
							</div>
						</div>
						<div class="cb_veiculo_info_titulo">Informação do veículo</div>
						<input class="cb_escondido" id="horas_de_partida" type="text" class="form-control" name="cb_obterhoraspartida" form="formulariocriar">
						<input class="cb_escondido" id="horas_de_destino" type="text" class="form-control" name="cb_obterhorasdestino" form="formulariocriar">
						<input class="cb_escondido" id="iddaviatura" type="text" name="cb_obteridviatura" form="formulariocriar">
						<div class="cb_divcomdivs">
							<div class="cb_vazia"></div>
							<div class="cb_veiculo_info">


								<label class="cb_matricula_label" for="matricula">Matrícula</label>
								<div class="cb_matricula">
									<input id="matricula" type="text" name="cb_obtermatricula" placeholder="" form="formulariocriar" required>
								</div>
								<div class="cb_seguro">
									<div class="cb_seguro_txt"></div>


								</div>
								<label class="cb_lotacao_label" for="lotacao">Lotação</label>
								<div class="cb_lotacao">
									<input type="number" id="lotacao" form="formulariocriar" name="cb_obterlotacao" min="1" max="9" required>
								</div>




							</div>
							<div class="cb_vazia"></div>
						</div>

						<div class="cb_botoes">
							<div id="iniciarcriarboleia" onClick="document.getElementById('formulariocriar').submit()" class="cb_botaoverde cb_cancelar">
								<div class="cb_botaoimagem">
									<img src="<?echo base_url()?>assets/imagens/cb_criar.svg">
								</div>
								<div class="cb_botaoadicionar cb_largurabotao">CRIAR BOLEIA</div>
							</div>
							<div class="cb_vazia2"></div>
							<div id="cancelarcriarboleia" onClick="$('#criarBoleia').modal('hide')" class="cb_botaoverde">
								<div class="cb_botaoimagem2">
									<img src="<?echo base_url()?>assets/imagens/cb_cancelar.svg"></div>
									<div class="cb_botaocancelar cb_largurabotao">CANCELAR</div>
								</div>
							</div>





						</form>
					</div>
					
				</div>
			</div>

			<!-- Fim do modal para criar boleia -->

			<!-- Modal bootstrap para inserir partida -->

			<div class="modal modalparaaesquerda" id="modalpartida" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="cb_total2">
						<input type="text" id="localapesquisar" class="cb_escondido">
						<input type="text" id="part" class="cb_escondido">
						<div class="cb_header">
							<div class="cb_headertexto">Inserir local</div>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body cb_pad">
							<p class="uwaga">Local nao existente na base de dados. Confirma que é o local que deseja criar?</p>
						</div>
						<div id="mapalocal"></div>
						<div class="divgrandeflex">
							
							<div class="cb_botaopequeno cb_corverde cpartida_respondeusim"><div class="cb_botaosimnao">Sim</div></div>
							<div class="cb_botaopequeno cb_corcinzenta" onClick="$('#modalpartida').modal('hide')" id="cpartida_respondeunao"><div class="cb_botaosimnao">Não</div></div>
						</div>
						<span class="uwaga margem">ou</span>
						<div class="cb_coordenadas">
							
							<p class="uwaga">Digite as coordenadas do local de destino</p>
							<div class="divpequenoflex">
								<label class="uwaga" for="lattd">Latitude:&nbsp;&nbsp;&nbsp;</label><input type="text" name="latitud" id="lattd">&nbsp;&nbsp;&nbsp;
								<label class="uwaga" for="longtd">Longitude:&nbsp;&nbsp;&nbsp;</label><input type="text" name="longitud" id="longtd">
							</div>
							<div class="cb_botaopequeno cb_corverde cb_floate cpartida_respondeusim">
								<div class="cb_botaook cb_paddingleft">
									OK
								</div>
							</div>
						</div>
					</div>				
				</div>
			</div>


			<!-- Fim do Modal bootstrap para inserir partida -->


			<!-- Modal bootstrap para inserir destino -->


			<!-- Fim do Modal bootstrap para inserir destino -->


			<!-- Modal bootstrap para inserir veículo -->

			<div class="modal" id="id_inserirveiculo" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<form action="<?php echo base_url().'activas/inserirVeiculo'; ?>", id="formveiculo">
						<div class="cv_total">
							<div class="cv_header">
								<div class="cv_headertexto">Criar viatura</div>
							</div>

							<div class="cv_dados">

								<div class="cv_marca">
									<label class="cv_label" for="cvidmarca">Marca</label>
									<input type="text" id="cvidmarca" size="15" name="cv_obtermarca">

									
								</div>
								<div class="cv_modelo">
									<label class="cv_label" for="cvidmodelo">Modelo</label>
									<input type="text" id="cvidmodelo" size="15" name="cv_obtermodelo">

									
								</div>
								<div class="cv_combustivel">
									<label class="cv_label" for="cvidcombustivel">Combust.</label>
									<select id="cvidcombustivel" class="form-control" name="cv_obtercombustivel">
										<?php foreach($combustivel as $comb):?>
											<option value="<?php echo $comb->IDCOMBUSTIVEL?>">
												<?php echo $comb->COMBUSTIVEL?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="cv_branco">
							</div>

							<div class="cv_divcomdivs">

								<div class="cv_matricula">
									<label class="cv_label" for="idmatricula">Matrícula</label>
									<input id="idmatricula" type="text" name="cv_obtermatricula" placeholder="">
								</div>

								<div class="cv_propr_viatura">
									<div class="cv_propr_viatura_txt">Viatura Empresa</div>
									<div class="cv_toggle checkbox checkbox-slider--b-flat">
										<label>
											<input name="cv_obterproprviatura" type="checkbox" value="true"><span></span>
										</label>
									</div>
								</div>

								<div class="cv_seguro_todos">
									<div class="cv_seguro_todos_txt">Seguro Contra todos os Riscos</div>
									<div class="cv_toggle checkbox checkbox-slider--b-flat">
										<label>
											<input name="cv_obterseguro" type="checkbox" value="true"><span></span>
										</label>
									</div>
								</div>


							</div>
							<div class="cv_branco">
							</div>

							<div class="cv_matricula">
							<label class="cv_label" for="cv_lotacao">Lotação</label>
								<input type="number" id="cv_lotacao" name="cv_obterlotacao" min="1" max="9" required>
							</div>


							<div class="cv_botoes">
								<div id="iniciarcriarveiculo" class="cv_botaoverde cv_cancelar">
									<div class="cv_botaoimagem">
										<img src="<?php echo base_url()?>assets/imagens/cb_criar.svg">
									</div>
									<div class="cv_botaoadicionar cv_largurabotao">CRIAR VEÍCULO</div>
								</div>
								<div class="cv_vazia2"></div>
								<div id="cancelarcriarveiculo" onClick="$('#id_inserirveiculo').modal('hide')" class="cv_botaoverde">
									<div class="cv_botaoimagem2">
										<img src="<?php echo base_url()?>assets/imagens/cb_cancelar.svg"></div>
										<div class="cv_botaocancelar cv_largurabotao">CANCELAR</div>
									</div>
								</div>






							</div>
						</form>
					</div>
				</div>

				<!-- Fim do Modal bootstrap para inserir veículo -->

				<!-- Modal de detalhes da boleia. É preenchido com o controlador "Obterdetalhesboleia" -->

				<div class="modal fade" data-backdrop="static" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div id="dados" class="modal-dialog larguramodalverboleias" role="document">

					</div>
				</div>

				<!-- Modal para adicionar encomenda -->

				<div class="modal fade" data-backdrop="static" id="modalencomenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div id="dados" class="modal-dialog larguramodalverboleias" role="document">

						<div class="enc_total">
							<div class="enc_header">
								<div class="enc_headertexto">Adicionar Encomenda</div>
							</div>
							<form action="<?php echo base_url()?>index.php/Encomenda/inserirEncomenda" id="criar_encomenda" method="post">
								<div class="enc_destinatario">Destinatário</div>
								<div class="enc_dados">
									<div class="enc_user">
										<div class="imagemlogin"><img src="<?php echo base_url()?>assets/imagens/user.png"></div>
									</div>
									<div class="enc_form">
										<input type="text" class="cb_escondido" id="idboleiaenc" name="enc_idboleia">
										<div class="enc_nempregado">
											<input type="text" placeholder="Nº Empregado..." name="enc_getEmpregado" id="encid_getEmpregado" size="13">
											<div class="enc_lupa" id="obter_user_por_nfunc">
												<img src="<?php echo base_url()?>assets/imagens/lupa_azul.svg">
											</div>
										</div>
										<div class="nomeuser">Por favor efectue uma pesquisa</div>
										<div class="enc_nomempregado">
											<input type="text" placeholder="Nome..." size="48" name="enc_getNomeEmpregado" id="encid_getNomeEmpregado">
											<div class="enc_lupa" id="obter_user_por_nome">
												<img src="<?php echo base_url()?>assets/imagens/lupa_azul.svg">
											</div>
										</div>
										<textarea placeholder="Descrição da Encomenda..." class="enc_descrip" rows="4" cols="50" name="enc_DescEncom"></textarea>
									</div>
								</div>





								<div class="enc_botoes">
									<div id="iniciarcriarboleia" onClick="document.getElementById('criar_encomenda').submit()" class="enc_botaoverde enc_cancelar">
										<div class="enc_botaoimagem">
											<img src="<?php echo base_url()?>assets/imagens/encomendas.svg">
										</div>
										<div class="enc_botaoadicionar enc_largurabotao">ADICIONAR</div>
									</div>

									<!--Colocar nome correcto do modal -->

									<div class="enc_espaco"></div>

									<div id="cancelarcriarboleia" onClick="$('#modalencomenda').modal('hide')" class="enc_botaoverde">
										<div class="enc_botaoimagem2">
											<img src="<?php echo base_url()?>assets/imagens/cb_cancelar.svg"></div>
											<div class="enc_botaocancelar enc_largurabotao">CANCELAR</div>
										</div>
									</div>

								</form>

							</div>
						</div>
					</div>

					<!-- Fim do modal para adicionar encomenda -->

					<!-- Mostrar encomenda -->

					<div id="mostrarencomenda" class="enc_total2 cb_escondido"></div>

					<!-- Mostrar caixa de mensagens -->

					<div class="modal fade" data-backdrop="static" id="modalmensagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div id="dados" class="modal-dialog larguramodalverboleias" role="document">

					<div id="32" class="azul">
						<div id="fecharmodal_caixamensagenstodas" class="mens_icone">
							<img src="<?php echo base_urL() ?>assets/imagens/cruz.svg">
						</div>
						<div class="mens_banneroculto azulclaro">
						</div>
						<div class="mens_bannerprincipal branco">
		
							<div class="container-fluid">
					    	
						                <div id="caixamensagens_todasboleias" class="msg-group center">
						                   
						                </div>
						                
						               
					              
					    	</div>
						</div>
					</div>
				</div>
			</div>

					<!-- Fim da caixa de mensagens -->



					<!-- Envio de mensagens -->
    
			<div class="modal fade" data-backdrop="static" id="modalenviomensagem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div id="dados" class="modal-dialog larguramodalverboleias" role="document">

            <div class="enc_total">
                <div class="enc_header">
                    <div class="enc_headertexto">Enviar mensagem</div>
                </div>
                <form action="<?php echo base_url()?>index.php/mensagens/enviarMensagem" id="criar_mensagem" method="post">
                <div class="enc_branco"></div>
                <input type="text" class="cb_escondido" id="msg_idboleiamsg" name="msg_obteridboleiamsg">
                <div class="msg_dados">
                    <div class="enc_user">
                        <div class="msg_imagemlogin"><img src="<?php echo base_url() ?>assets/imagens/user.png"></div>
                    </div>
                    <div class="msg_form">
                        <div class="enc_nempregado">
                            <select name="msg_tipomsg">
                                <option value="" disabled selected>Escolha um destinatário</option>
                                <option value="0">Administrador</option>
                                <option value="1">Condutor</option>
                                <option value="2">Todos os passageiros da boleia</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
                <div class="msg_caixa">
                    <textarea name="msg_caixamsg" placeholder="Escreva a sua mensagem..." class="enc_descrip" rows="6" cols="66"></textarea>
                </div>

                    
                  

                    <div class="enc_botoes">
                        <div id="iniciarenviomensagem" onClick="document.getElementById('criar_mensagem').submit()" class="enc_botaoverde enc_cancelar">
                            <div class="enc_botaoimagem">
                                <img src="<?php echo base_url() ?>assets/imagens/encomendas.svg">
                            </div>
                            <div class="enc_botaoadicionar enc_largurabotao">ENVIAR</div>
                        </div>
                        
                         <!--Colocar nome correcto do modal -->
                        
                        <div class="enc_espaco"></div>
                        
                        <div id="cancelarcriarboleia" onClick="$('#modalenviomensagem').modal('hide')" class="enc_botaoverde">
                            <div class="enc_botaoimagem2">
                                <img src="<?php echo base_url()?>assets/imagens/cb_cancelar.svg"></div>
                            <div class="enc_botaocancelar enc_largurabotao">CANCELAR</div>
                        </div>
                    </div>

                    </form>




            </div>
         </div>
			</div>

         		<!-- Fim do Envio de mensagens -->


					<!-- Filtros -->

					<div class="flt_rectangulo" id="filtroderesultados">
						<div class="flt_barra">
							<div class="flt_barratexto flt_fontesegoeregular">
								Filtrar
							</div>     
							<div id="setafechar" class="flt_seta"><img src="<?php echo base_url()?>assets/imagens/triangulo.svg"></div>
						</div>
						<div class="flt_rectangulobranco">
							<div class="flt_ordenar flt_fontesegoebold flt_textoverde">Ordenar</div>
							<div class="flt_ordem">
								<div id="flt_ordem_destino" class="flt_ordem_icone">
									<img src="<?php echo base_url()?>assets/imagens/ordem.svg">
								</div>
								<div class="flt_ordem_texto flt_fontesegoeregular">
								Destino</div>
							</div>
							<div class="flt_ordem">
								<div id="flt_ordem_data" class="flt_ordem_icone">
									<img src="<?php echo base_url()?>assets/imagens/ordem.svg">
								</div>
								<div class="flt_ordem_texto flt_fontesegoeregular">
								Data de partida</div>
							</div>

							<div class="flt_semnada">
								<input class="cb_escondido" id="valordashoras1">
							</div>
							<div class="flt_horas"><div class="flt_horas_texto flt_fontesegoeboldverde">Hora de saída</div>
							<div class="flt_semnada">
							</div>
							<div id="slider_filtro">
								<div id="flthorasbarra" class="flt_horas_barra"></div>
							</div>
							<div class="flt_semnada"></div>
							<div class="flt_estado">
								<div class="flt_estado_texto flt_fontesegoeboldverde">Estado</div>
								<div class="flt_estado_flex">
									<div class="flt_umestado">
										<input id="Est_Completo" class="flt_estado_checkbox" type="checkbox">

								<!--<div class="flt_umestado_img">
									<img src="<?php echo base_url()?>assets/imagens/estado1.svg">
								</div>-->

										<label class="flt_estado_checkbox_txt" for="Est_Completo">Completo</label>
									</div>
									<div class="flt_umestado flt_estado_margem">
										<input id="Est_Cancelado" class="flt_estado_checkbox" type="checkbox">
										<!-- <div class="flt_umestado_img">
											<img src="<?php echo base_url()?>assets/imagens/estado2.svg">
										</div> -->
										<label class="flt_estado_checkbox_txt" for="Est_Cancelado">Cancelado</label>
									</div>
									<div class="flt_umestado">
										<input id="Est_Pendente" class="flt_estado_checkbox" type="checkbox">
										<!-- <div class="flt_umestado_img">
											<img src="<?php echo base_url()?>assets/imagens/estado3.svg">
										</div> -->
										<label class="flt_estado_checkbox_txt" for="Est_Pendente">Pendente</label>
									</div>
									<div class="flt_umestado flt_estado_margem2">
										<input id="Est_Canc_Admin" class="flt_estado_checkbox" type="checkbox">
										<!-- <div class="flt_umestado_img">
											<img src="<?php echo base_url()?>assets/imagens/estado4.svg">
										</div> -->
										<label class="flt_estado_checkbox_txt" for="Est_Canc_Admin">Canc. Admin</label>
									</div>
								</div>
							<button type="button" id="flt_idbotaofiltro" class="btn btn-link flt_botaofiltro"><i class="fa fa-filter"></i>Aplicar filtro</button>

					</div>
					
				</div>

			</div>

		</div>

		<!-- Fim dos filtros -->

		<!-- Modal para mostrar QR Code -->

		<div class="modal fade" data-backdrop="static" id="modalqrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div id="dados" class="modal-dialog" role="document">
				
			<div class="qrq_total">
                <div class="mt-4 ml-4 qrq_dados d-flex justify-content-center mr-4 text-center">
                    Para sua comodidade, faça o download da aplicação para o seu Smartphone Android.
                </div>
                <div class="text-center">
                     <a href="<?php echo base_url()?>assets/app/SoftPool_By_Softinsa_V0.1.apk"><img src="<?php echo base_url()?>assets/qr/qrcode.png" class="img-fluid qrq_size" alt="<?php echo base_url()?>assets/app/SoftPool_By_Softinsa_V0.1.apk"></a>
                </div>
            </div>

			</div>
		</div>

		<div id="snackbar"></div>












		<!-- O footer destina-se a delimitar o espaço da página -->



		<footer class="contentor2 flex2">
			<p> 
				<!--        A página foi carregada em <?php /*echo $this->benchmark->elapsed_time();*/ ?> segundos.-->

				

				<div class="espaco">
				</div>

				<div class="cb_ecraconfirmacao cb_escondido ">
					<div class="cb_header">
					</div>

					<div class="cb_sucesso">
						<div class="cb_sucesso_img"><img src="<?php echo base_url()?>assets/imagens/map.png"></div>
						<div class="cb_sucesso_txt_e_botao"><div class="cb_sucesso_txt">Boleia criada com Sucesso</div><div class="cb_botaoverdepequeno"><div class="cb_botaoverdepequeno_txt">VOLTAR</div></div></div>

					</div>
				</div>

				<div class="espaco">
				</div>








			</footer>

			<!-- ------------------------------------------- -->
			<!-- Javascripts importados -->

			<script src="<?php echo base_url()?>assets/vendor/js/jquery-3.0.0.js"></script>
			<script src="<?php echo base_url()?>assets/vendor/js/jquery-3.0.0.min.js"></script>


			<script src="<?php echo base_url()?>assets/vendor/js/bootstrap.min.js"></script>
			<script src="<?php echo base_url()?>assets/vendor/js/bootstrap.bundle.min.js"></script>
			<script src="<?php echo base_url()?>assets/vendor/js/highlight.min.js"></script>


			<script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/moment-with-locales.js"></script>   
			<script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/slider/nouislider.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/slider/wNumb.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/datepicker/tempusdominus-bootstrap-4.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/jquery-ui.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/datatables/jquery.dataTables.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/datatables/dataTables.responsive.js"></script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/jquery.form.min.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZl2ad3Z7WU2QwxU-OOJ6wsfWw2TsfJXk&libraries=places&v=3.31" async defer></script>
			<!-- <script type="text/javascript" src="<?php echo base_url()?>assets/vendor/js/datatables/scroller.jqueryui.js"></script> -->

			<!-- Javascripts de implementação própria, ficaram inline -->

			<script type="text/javascript">

		/*=======================================================
		Voltar ao início
		=========================================================*/

		$('#voltarinicio').on('click',function(){
			window.open('<?php echo base_url()?>index.php/activas/pool');
		});


		/*=======================================================
		Google Map
		=========================================================*/

		var service;
		var map;
		var map_local;

		var ServicoMostrar;
		var ServicoRota;
		

		function createMarker(place) {
			var marker = new google.maps.Marker({
				map: map_local,
				position: place.geometry.location
			});
		}

		function criarMarcadorCoordenadas(local) {
			var marker = new google.maps.Marker({
				map: map,
				position: local
			});
		}

		function marcar_e_recentrar(results, status)
		{
			if (status == google.maps.places.PlacesServiceStatus.OK) {
				createMarker(results[0]);
				

				var lat = results[0].geometry.location.lat();
				var long = results[0].geometry.location.lng();

				map_local.setOptions({ zoom: 8,
					center:{lat:lat, lng:long}
				})

				$('#lattd').val(lat);
				$('#longtd').val(long)
			}

		}

		function PesquisarLocais(local)
		{
			const meubounds = new google.maps.LatLngBounds({lat:36.92,lng:-9},{lat:42.2,lng:-6});

			var request = {
				query: local,
				bounds: meubounds
			}

			service.textSearch(request, marcar_e_recentrar);
		}



		function initMap(elem){
					//opções do mapa
					
					var options = {
						zoom: 5,
						center:{lat:40.6566,lng:-7.9125 }
					}
					
					
					//criação do mapa
					map = new google.maps.Map(document.getElementById(elem),options);
				

					ServicoMostrar = new google.maps.DirectionsRenderer({
						map: map
					});
					ServicoRota = new google.maps.DirectionsService();

				};

				function FazerRota(inicio, fim) {
					var request = {
						origin: inicio,
						destination: fim,
						travelMode: "DRIVING"
					};

					ServicoRota.route(request, function(response, status){
						if(status == google.maps.DirectionsStatus.OK)
						{
							ServicoMostrar.setDirections(response);
							google.maps.event.trigger(map, 'resize');
						}
					});		


				}

			function initMap_locais(){
			//opções do mapa
			
			var options = {
				zoom: 5,
				center:{lat:40.6566,lng:-7.9125 }
			}
			
			
			//criação do mapa
			map_local = new google.maps.Map(document.getElementById('mapalocal'),options);
			
			service = new google.maps.places.PlacesService(map_local);
			
			
		};


		/*=======================================================
		Filtro Boleias do Utilizador
		=========================================================*/

		var escolha = -1;

		$(document).ready(function() {
			$('#filt_activas').on('click', function () {
				$('#filtroderesultados').toggleClass("flt_mostrar");
				escolha = 0;
			});

			$('#filt_local').on('click', function () {
				$('#filtroderesultados').toggleClass("flt_mostrar");
				escolha = 1;
			});
		});

		/*=======================================================
		Tornar filtro movível
		=========================================================*/

		/* Código obtido em W3SCHOOLS*/ 

		dragElement(document.getElementById("filtroderesultados"));

		function dragElement(elmnt) {
			var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
			if (document.getElementById(elmnt.id + "header")) {
				/* if present, the header is where you move the DIV from:*/
				document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
			} else {
				/* otherwise, move the DIV from anywhere inside the DIV:*/
				elmnt.onmousedown = dragMouseDown;
			}

			function dragMouseDown(e) {
				e = e || window.event;
				e.preventDefault();
			// get the mouse cursor position at startup:
			pos3 = e.clientX;
			pos4 = e.clientY;
			document.onmouseup = closeDragElement;
			// call a function whenever the cursor moves:
			document.onmousemove = elementDrag;
		}

		function elementDrag(e) {
			e = e || window.event;
			e.preventDefault();
			// calculate the new cursor position:
			pos1 = pos3 - e.clientX;
			pos2 = pos4 - e.clientY;
			pos3 = e.clientX;
			pos4 = e.clientY;
			// set the element's new position:
			elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
			elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
		}

		function closeDragElement() {
			/* stop moving when mouse button is released:*/
			document.onmouseup = null;
			document.onmousemove = null;
		}
	}



		/*=======================================================
		DataTables
		=========================================================*/

		var saindode;
		var saindoporuser;
		var variavel = undefined;

		/* Boleias a sair da área de trabalho do utilizador */
		$(document).ready( function () {
			saindode = $('#Asairde').DataTable({
				"searching": false,
				"paging": false,
				"info": false,
				"language": {
			      	"emptyTable": "Não existem boleias para apresentar"
			    }
			});
		} );

		/* Boleias em que o utilizador se encontra */
		$(document).ready( function () {
			saindoporuser = $('#Asairporuser').DataTable({
				"searching": false,
				"paging": false,
				"info": false,
				"language": {
			      	"emptyTable": "Não existem boleias para apresentar"
			    }
			});
		} );

		/* Boleias pesquisadas */
		$(document).ready(function() {
			$('#results_pesquisa').DataTable({
				searching: false,
				paging: false,
				info: false,
				"language": {
			      	"emptyTable": "Não existem boleias para apresentar"
			    }
			});
		});

		var ordem_destino = 'asc';
		var ordem_data = 'asc';

		$('div').on('click', '#flt_ordem_destino', function () {
			if(escolha == 0)
				saindoporuser.column('7').order(ordem_destino).draw();
			else if(escolha ==1)
				saindode.column('6').order(ordem_destino).draw();


			if(ordem_destino == 'asc')
				ordem_destino = 'desc';
			else
				ordem_destino = 'asc';
		});



		$('div').on('click', '#flt_ordem_data', function () {
			if(escolha == 0)
				saindoporuser.column('0').order(ordem_data).draw();
			else if(escolha ==1)
				saindode.column('0').order(ordem_data).draw();

			if(ordem_data == 'asc')
				ordem_data = 'desc';
			else
				ordem_data = 'asc';
		});
					// variavel = 'desc';
					// saindoporuser.ajax.reload().clear().draw();




				/*var filteredData = table
					.column( 0 )
					.data()
					.filter( function ( value, index ) {
						return value > 15 ? true : false;
					} );*/


				/*$('#valordashoras1').on('keyup',function(){
					 table.search(this.value).draw();
					});*/


		/*=======================================================
		noUISlider - Hora da boleia
		=========================================================*/

		var slider_partida = document.getElementById('sliderpartida');
		var slider_destino = document.getElementById('sliderdestino');

		var HoraAproximada = function (mins)
		{
					//http://greweb.me/2013/01/be-careful-with-js-numbers/
					var minutes = Math.round(mins % 60);
					if (minutes == 60 || minutes == 0)
					{
						return mins / 60;
					}
					return Math.trunc (mins / 60) + minutes / 100;
				}


				function filter_hour(value, type) {
					return (value % 60 == 0) ? 1 : 0;
				}

				/* Slider hora de partida */

				noUiSlider.create(slider_partida, {
					start: [ 30 ],
					connect: true,
					tooltips: [ true ],
					range: {
						'min': 0,
						'max': 1410
					},
					step: 30,
					format:  wNumb({
						decimals: 2,
						mark: ":",
						encoder: function(a){
							return HoraAproximada(a);
						}
					}),

				});

				/* Slider hora de destino */

				noUiSlider.create(slider_destino , {
					start: [ 30 ],
					connect: true,
					tooltips: [ true ],
					range: {
						'min': 0,
						'max': 1410
					},
					step: 30,
					format:  wNumb({
						decimals: 2,
						mark: ":",
						encoder: function(a){
							return HoraAproximada(a);
						}
					}),

				});

				noUiSlider.create(slider_filtro , {
					start: [ 30 , 330 ],
					connect: true,
					tooltips: [ true , true ],
					range: {
						'min': 0,
						'max': 1410
					},
					step: 30,
					format:  wNumb({
						decimals: 2,
						mark: ":",
						encoder: function(a){
							return HoraAproximada(a);
						}
					}),

				});


				slider_partida.noUiSlider.on('update', function(values, handle) {
					document.getElementById("horas_de_partida").value = values;
				}); 

				slider_destino.noUiSlider.on('update', function(values, handle) {
					document.getElementById("horas_de_destino").value = values;
				}); 

				slider_filtro.noUiSlider.on('update', function(values, handle) {
					document.getElementById("valordashoras1").value = values;
				});

				$('#flt_idbotaofiltro').on('click',function(){

					var horas = $("#valordashoras1").val();

					var hora1 = horas.substr(0,horas.indexOf(','));
					var hora2 = horas.substr(horas.indexOf(',')+1,horas.length);

					
				});


		/*=======================================================
		datetimepicker - Escolha da data da boleia
		=========================================================*/


		$(function () {
			$('#datetimepicker1').datetimepicker({
				format: 'YYYY-MM-DD',
				icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-calendar-check-o',
					clear: 'fa fa-trash-o',
					close: 'fa fa-close'
				}
			});
		});

		$(function () {
			$('#datetimepicker3').datetimepicker({
				format: 'YYYY-MM-DD',
				icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-calendar-check-o',
					clear: 'fa fa-trash-o',
					close: 'fa fa-close'
				}
			});
		});


		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
		});


		/*=======================================================
		Mostra o ecrã de detalhes de cada boleia
		=========================================================*/   

		$(document).ready(function(){
			$('tbody').on('click', '.bleia', function () {                   
				var idbleia = $(this).attr('id');

				$.ajax({
					url: '<?php echo base_url()?>index.php/obterdetalhesboleia/detalhesboleia/'+idbleia, 
					method: "post",
					data: { idbleia : idbleia },
					success:function(resultado){
						$('#dados').html(resultado);
						$('#mymodal').modal("show");
						
						var inic = $('#mb_get_coordpartida_'+idbleia).val();
						var fi = $('#mb_get_coorddestino_'+idbleia).val();

						/* Obter coordenadas partida */
						identif = 'mapa' + idbleia;

						initMap(identif);
						setTimeout(function(){FazerRota(inic, fi);},1000);	


							}
						});
					
				});

			});

		

		/*=======================================================
		Snackbar quando existem mensagens flash
		=========================================================*/ 


		$(document).ready(function(){
			$.ajax({
				url: '<?php echo base_url()?>index.php/obterflash/flash', 
				method: "post",		 		
			}).done(function(result){
				if(result != 0)
				{
					var x = document.getElementById("snackbar");

					var texto = document.createTextNode(result);

					x.appendChild(texto);

					x.className = "show";

					setTimeout(function(){ x.className = x.className.replace("show", ""); x.removeChild(texto);}, 3000);
				}
			});
		});


				// var x = document.getElementById("snackbar");
				// 			var conteudo1;

				// 			if(resultado==-1)
				// 				conteudo1 = document.createTextNode('Ocorreu um erro. Contacte o administrador');
				// 			else if(resultado==0)
				// 				conteudo1 = document.createTextNode('Boleia cheia e já se encontra inscrito. Não se pode inscrever.');
				// 			else if(resultado==1)
				// 				conteudo1 = document.createTextNode('Boleia cheia. Não se pode inscrever.');
				// 			else
				// 				conteudo1 = document.createTextNode('Já se encontra na boleia. Não se pode inscrever.');

				// 			x.appendChild(conteudo1);

				// 			x.className = "show";

				// 			setTimeout(function(){ x.className = x.className.replace("show", ""); x.removeChild(conteudo1);}, 3000);


		/*=======================================================
		Definicao e call à função de troca partida / destino
		=========================================================*/ 

		function swap(a, b) {
			a = $(a); b = $(b);
			var tmp = $('<span>').hide();
			a.before(tmp);
			b.before(a);
			tmp.replaceWith(b);
		};

		$(document).ready(function(){
			$("#volswap").click(function(){
				swap("#_part","#_dest");
			});


		});

		/*=======================================================
		Função de fecho do modal no botão "x"
		=========================================================*/ 

		$(document).ready(function(){
			$('div').on('click','#fecharmodal',function(){
				$('#mymodal').modal('hide');
			});
		});


		 /*=======================================================
		Ao adicionar utilizador na boleia, seleccionar se o objectivo da boleia é pessoal ou profissional
		=========================================================*/ 

		$(document).on({
			"mouseenter": function() {

				$('#acordeao').addClass("esconder");
				$('#subbotoes').removeClass("esconder");

			},
			"mouseleave": function() {
				setTimeout(function(){ 

					$('#acordeao').removeClass("esconder");
					$('#subbotoes').addClass("esconder");

				},1500);

			}
		},"#acordeao");

		/*=======================================================
		Adicionar utilizador a boleia
		=========================================================*/ 

		(function($){
			$(document).on('click', '.mb_addbprof', function(e){
				ExecutarAdicionarBoleia.call(this, e, 0);
			});
		})(jQuery);

		(function($){
			$(document).on('click', '.mb_addbpess', function(e){
				ExecutarAdicionarBoleia.call(this, e, 1);
			});
		})(jQuery);

		function ExecutarAdicionarBoleia(event, pessoal){
			var str = (this.id).substring(6);
			if(isNaN(str))
			{
				alert('Número da boleia não foi obtido correctamente')    
			}
			/* O número da boleia é válido*/
			else
			{
				/* Vai verificar o numero de lugares, e se já está inscrito. */
				/* Resultado -1 : Devolveu resultados discordantes (duas linhas da BD) */
				/* Resultado 0 : Boleia cheia E já está inscrito */
				/* Resultado 1 : Boleia cheia  */
				/* Resultado 2 : Já está inscrito  */
				/* Resultado 3 : Inserção normal  */
				/* Resultado 4 : Inserção com troca pessoal <-> profissional */
				$.ajax({
					url: '<?php echo base_url()?>index.php/Adicionaraboleia/verificarlugares_e_seestainscrito/', 
					method: "post",
					data: { idbleia : str,
						pessoall : pessoal
					},
					success:function(resultado){
						if(resultado == -1 || resultado == 0 || resultado == 1 || resultado == 2)
						{
							var x = document.getElementById("snackbar");
							var conteudo1;

							if(resultado==-1)
								conteudo1 = document.createTextNode('Ocorreu um erro. Contacte o administrador');
							else if(resultado==0)
								conteudo1 = document.createTextNode('Boleia cheia e já se encontra inscrito. Não se pode inscrever.');
							else if(resultado==1)
								conteudo1 = document.createTextNode('Boleia cheia. Não se pode inscrever.');
							else
								conteudo1 = document.createTextNode('Já se encontra na boleia. Não se pode inscrever.');

							x.appendChild(conteudo1);

							x.className = "show";

							setTimeout(function(){ x.className = x.className.replace("show", ""); x.removeChild(conteudo1);}, 3000);
						}
						else if(resultado == 3)
						{
							$.ajax({
								url: '<?php echo base_url()?>index.php/Adicionaraboleia/adicionar/', 
								method: "post",
								data: { idbleia : str,
									pessoall : pessoal },
									statusCode: { 500: function(){
										var x = document.getElementById("snackbar");
										
										var erro = document.createTextNode('Encontra-se nas 24 horas anteriores ao início da boleia, ou ocorreu um erro');

										x.appendChild(erro);

										x.className = "show";

										setTimeout(function(){ x.className = x.className.replace("show", ""); x.removeChild(erro);}, 3000);	
									}},
									success:function(resultado){


										if(resultado == 0)
										{
											var y = document.getElementById("snackbar");

											var conteudo2 = document.createTextNode('Não foi possível inscrever-se na boleia.');

											y.appendChild(conteudo2);

											y.className = "show";

											setTimeout(function(){ y.className = y.className.replace("show", ""); y.removeChild(conteudo2);}, 3000);
										}
										else
										{
											var z = document.getElementById("snackbar");

											var conteudo3 = document.createTextNode('Inscreveu-se com sucesso na boleia.');

											z.appendChild(conteudo3);

											z.className = "show";

											setTimeout(function(){ z.className = z.className.replace("show", ""); }, 3000);
											setTimeout(function(){window.location.reload(true);}, 2000);
										}

									}
								});
							
						}
						else
						{
							$.ajax({
								url: '<?php echo base_url()?>index.php/Adicionaraboleia/adicionar_profissional_com_troca/'+str, 
								method: "post",
								data: { str : str },
								success:function(resultado){


									if(resultado == 0)
									{
										var y = document.getElementById("snackbar");

										var conteudo2 = document.createTextNode('Não foi possível inscrever-se na boleia.');

										y.appendChild(conteudo2);

										y.className = "show";

										setTimeout(function(){ y.className = y.className.replace("show", ""); y.removeChild(conteudo2);}, 3000);
									}
									else
									{
										var z = document.getElementById("snackbar");

										var conteudo3 = document.createTextNode('Inscreveu-se com sucesso na boleia.');

										z.appendChild(conteudo3);

										z.className = "show";

										setTimeout(function(){ z.className = z.className.replace("show", ""); }, 3000);
										setTimeout(function(){window.location.reload(true);}, 2000);
									}

								}
							});
						}

					},
				});


			}
		}

		/*=======================================================
		Cancelar inscrição de utilizador na boleia
		=========================================================*/ 

		(function($){
			$(document).on('click', '.mb_cancb', function(e){
				ExecutarCancelarBoleia.call(this, e);
			});
		})(jQuery);

		function ExecutarCancelarBoleia(event){
			var idbooleia = (this.id).substring(6);
			if(isNaN(idbooleia))
			{
				alert('Número da boleia não foi obtido correctamente')    
			}
			else
			{

				/* Verificar se vai na boleia. Se sim - É obtido o idutilizador boleia */

				$.ajax({
					url: '<?php echo base_url()?>index.php/Adicionaraboleia/verificarsevainaboleia/'+idbooleia, 
					method: "post",
					data: { idbooleia : idbooleia },
					success:function(resultado){
						if(resultado == 0)
						{    
							var x = document.getElementById("snackbar");

							var conteudo1 = document.createTextNode('Não foi possível cancelar a sua boleia.');

							x.appendChild(conteudo1);

							x.className = "show";

							setTimeout(function(){ x.className = x.className.replace("show", ""); x.removeChild(conteudo1);}, 3000);


						}
						else
						{   
							var idutilbol = resultado;

							/* Cancelar. Se foi cancelado, faz reload com snackbar */

							$.ajax({
								url: '<?php echo base_url()?>index.php/Adicionaraboleia/cancelar/'+idutilbol, 
								method: "post",
								data: { idutilbol : idutilbol },
								success:function(resultnovo){
									if(resultnovo == 0 || resultnovo == -1)
									{
										var y = document.getElementById("snackbar");

										var conteudo2;

										if(resultnovo == 0)
											conteudo2 = document.createTextNode('Não foi possível cancelar a sua boleia.');
										else if(resultnovo == -1)
											conteudo2 = document.createTextNode('Não foi possível cancelar, pois é o condutor da boleia.');

										y.appendChild(conteudo2);

										y.className = "show";

										setTimeout(function(){ y.className = y.className.replace("show", ""); y.removeChild(conteudo2);}, 3000);
									}
									else
									{
										var z = document.getElementById("snackbar");

										var conteudo3 = document.createTextNode('Foi removido com sucesso da boleia.');

										z.appendChild(conteudo3);

										z.className = "show";

										setTimeout(function(){ z.className = z.className.replace("show", ""); }, 3000);
										setTimeout(function(){window.location.reload(true);}, 2000);
									}
								}
							});}
						}
					});


			}
		}


		/*=======================================================
		Autocompletar
		=========================================================*/ 

		$(document).ready(function(){
			$( "#_part" ).autocomplete({
				source: "<?php echo site_url('activas/autocomplet/?');?>"
			});
			
			$( "#_dest" ).autocomplete({
				source: "<?php echo site_url('activas/autocomplet/?');?>"
			});
			
			$( "#cbidpartida" ).autocomplete({
				source: "<?php echo site_url('activas/autocomplet/?');?>"
			});
			
			$( "#cbiddestino" ).autocomplete({
				source: "<?php echo site_url('activas/autocomplet/?');?>"
			});

			$( "#cvidmarca" ).autocomplete({
				source: "<?php echo site_url('activas/autocomplet_marc/?');?>"
			});	

			$( "#cvidmodelo" ).autocomplete({
				source: "<?php echo site_url('activas/autocomplet_modl/?');?>"
			});	

			$( "#matricula" ).autocomplete({
				source: "<?php echo site_url('activas/autocomplet_matr/?');?>"
			});	



		});

		 /*=======================================================
		 Funções auxiliares da criação de boleia
		 =========================================================*/     


		 /* verificar se o local de partida está criado e, caso necessário, criar */

		 
		 	$('#cbidpartida').focusout(function(){
		 		var locs = $('#cbidpartida').val();

		 		$.ajax({
		 			url: '<?php echo base_url()?>index.php/criar/verificarLocal',
		 			method: "post",
		 			data: {locs},
		 			success: function(result)
		 			{
		 				if(result == -1)
		 				{
		 					$('#part').val('0');

		 					$('#modalpartida').modal('show');

		 					initMap_locais();
							PesquisarLocais(locs);

							$('#localapesquisar').val(locs);
		 				}
		 				else
		 				{
		 					document.getElementById("iddapartida").value = result;
		 				}
		 			}
		 		});
		 	});





		 /* verificar se o local de destino está criado e, caso necessário, criar */ 

		 	$('#cbiddestino').focusout(function(){
		 		var locs = $('#cbiddestino').val();

		 		$.ajax({
		 			url: '<?php echo base_url()?>index.php/criar/verificarLocal',
		 			method: "post",
		 			data: {locs},
		 			success: function(result)
		 			{
		 				if(result == -1)
		 				{
		 					$('#part').val('1');

		 					$('#modalpartida').modal('show');

		 					initMap_locais();
							PesquisarLocais(locs);

							$('#localapesquisar').val(locs);
		 				}
		 				else
		 				{
		 					document.getElementById("iddodestino").value = result;
		 				}
		 			}
		 		});
		 	});

	
		 $('.cpartida_respondeusim').one('click',function(event){
			var loc = $('#localapesquisar').val();

			$.ajax({
					url: "<?php echo base_url()?>index.php/criar/inserirLocal/", 
					method: "post",
					cache: false,
					data: {loc: loc,
						latitud: $('#lattd').val(),
						longitud: $('#longtd').val()
					},
					success:function(resultado){
						if(resultado!=-1 && $('#part').val() == 0)
						{
							$('#modalpartida').modal('hide'); document.getElementById("iddapartida").value = resultado;
						}
						else if(resultado!=-1 && $('#part').val() == 1)
						{
							$('#modalpartida').modal('hide'); document.getElementById("iddodestino").value = resultado;
						}
						else
						{
							alert("Nao inseriu");
							$('#modalpartida').modal('hide')
						}
					}
					
				});
			
			});

		 /* verificar se o veículo está criado e, caso necessário, criar */
            $('#matricula').focusout(function(){
                var matricula = $('#matricula').val();
 
                $('#idmatricula').val(matricula);
 
                $.ajax({
                    url: '<?php echo base_url()?>index.php/criar/obterVeiculoviaMatricula', 
                    method: "post",
                    data: {matricula}
                }).done(function(result){
                    if(result == -1)
                    {
                        $('#id_inserirveiculo').modal('show');
                    }
                    else
                    {
                        document.getElementById("iddaviatura").value = result;
                    }
                });
            });


		 function EmCasodeSucesso(data)
		 {
		 	if(data != -1)
		 	{
		 		var z = document.getElementById("snackbar");

		 		var conteudo = document.createTextNode('Veículo Inserido com sucesso.');

		 		z.appendChild(conteudo);

		 		z.className = "show";

		 		setTimeout(function(){ z.className = z.className.replace("show", ""); }, 3000);
		 		/*setTimeout(function(){window.location.reload(true);}, 2000);*/

		 		$('#id_inserirveiculo').modal('hide');
		 		document.getElementById("iddaviatura").value = data;
		 	}
		 	else
		 	{
		 		var w = document.getElementById("snackbar");

		 		var conteudo2 = document.createTextNode('Não foi possível inserir veículo.');

		 		w.appendChild(conteudo2);

		 		w.className = "show";

		 		setTimeout(function(){ w.className = w.className.replace("show", ""); w.removeChild(conteudo2);}, 3000);
		 	}
		 }

		 $("#formveiculo").ajaxForm({url: '<?php echo base_url()?>index.php/criar/inserirVeiculo', type: 'post', success: EmCasodeSucesso});

		 $('#iniciarcriarveiculo').on('click',function ExecutarAdicionarVeiculo(event){
		 	$('#formveiculo').submit()
		 });

		 /*=======================================================
		 Envio de encomenda
		 =========================================================*/   

		 $(document).on('click','.mb_addenc', function(){
		 	$('#idboleiaenc').val((this.id).substring(6));
		 	$('#modalencomenda').modal('show');

		 });

		 $('#obter_user_por_nfunc').on('click', function(){
		 	var nfunc = $('#encid_getEmpregado').val();
		 	$.ajax({
		 		url: '<?php echo base_url()?>index.php/Encomenda/obterNomeUtil/'+nfunc, 
		 		method: "post",
		 	}).done(function(result){
		 		$('#encid_getNomeEmpregado').val(result);
		 	});
		 });

		 $('#obter_user_por_nome').on('click', function(){
		 	var nomefunc = $('#encid_getNomeEmpregado').val();
		 	$.ajax({
		 		url: '<?php echo base_url()?>index.php/Encomenda/obterNumeroFunc/', 
		 		method: "post",
		 		data: {nomefunc : nomefunc}
		 	}).done(function(result){
		 		$('#encid_getEmpregado').val(result);
		 	});
		 });

		
		/*======================================================
		 Mostrar Encomenda
		 =========================================================*/   


		 $(document).on('click','.mb_obterBagbagagem',function(){
		 	var id = (this.id).substring(6);

		 	$.ajax({
					url: '<?php echo base_url()?>index.php/encomenda/obterencomenda/'+id,
					method: "post",
					success:function(resultado){
						$('#mostrarencomenda').removeClass('cb_escondido');
						$('#mostrarencomenda').html(resultado);
					}
				});
		 });

		  $(document).on('mouseleave','.mb_obterBagbagagem',function(){
		 	$('#mostrarencomenda').addClass('cb_escondido');
		 });


		/*======================================================
		Mostrar Encomenda
		=========================================================*/   

		$('#download_appp').on('click',function(){
			$('#modalqrcode').modal('show');
		});


		/*======================================================*/
		/*======================================================*/
		/*======================================================*/
		/*MENSAGENS*/
		/*======================================================*/ 

  		/*======================================================*/
		/*Todas as boleias*/
		/*======================================================*/ 

		 $('#funcaodechat').on('click',function(){
		 	$('#modalmensagens').modal('show');

		 	$.ajax({
					url: '<?php echo base_url()?>index.php/mensagens/ObterMensagens_de_Todas_boleias/', 
					method: "post",
					/*data: { idbleia : idbleia },*/
					success:function(resultado){
						$('#caixamensagens_todasboleias').html(resultado);
					}
			});

		 	
		 });

		 $('#fecharmodal_caixamensagenstodas').on('click',function(){
		 	$('#modalmensagens').modal('hide');
		 });

		 
  		/*======================================================*/
		/*Só as mensagens de uma boleia*/
		/*======================================================*/ 

		$(document).on('click','.mb_caixamensagens',function(){
			$('#modalmensagens').modal('show');
			var isto = $('.mb_caixamensagens').attr('data-id');

			$.ajax({
					url: '<?php echo base_url()?>index.php/mensagens/ObterMensagens_de_uma_Boleia/'+isto, 
					method: "post",
					success:function(resultado){
						$('#caixamensagens_todasboleias').html(resultado);
					}
			});
			
		});

		/*======================================================*/
		/*Envio de mensagens*/
		/*======================================================*/ 

		$(document).on('click','.mb_contactartodos',function(){
			$('#modalenviomensagem').modal('show');
			$('#msg_idboleiamsg').val($('.mb_contactartodos').attr('data-id'));

		});

		</script>




	</body>
	</html>