<?php $this->load->view('admin/includes/headerside'); ?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Editar Boleias</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php echo validation_errors();?>
							<?php if ($this->session->flashdata('category_success')) { ?>
        						<div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
    						<?php } ?>
    						<?php if ($this->session->flashdata('category_error')) { ?>
    							<div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
							<?php } ?>
						
							<?php if(isset($boleia)):?>
							<?php echo form_open_multipart('admin/gestaoboleias/editar');?>

								<div class="form-group">
									<label>Boleia a alterar</label>
									<input class="form-control" name="idboleia" value="<?php echo $boleia->IDBOLEIA?>" readonly>
								</div>
								
								<div class="form-group">
									<label>Local Origem</label>
									<select class="form-control" name="idorigem">
										<?php foreach($locais->result() as $linha): ?>
										<option value="<?php echo $linha->IDLOCAL?>"><?php echo $linha->NOME_CIDADE?></option>
									<?php endforeach; ?>
									</select>
								</div>
								
								<div class="form-group">
									<label>Local Destino</label>
									<select class="form-control" name="iddestino">
										<?php foreach($locais->result() as $linha): ?>
										<option value="<?php echo $linha->IDLOCAL?>"><?php echo $linha->NOME_CIDADE?></option>
									<?php endforeach; ?>
									</select>
								</div>

								<div class="form-group">
									<label>Data de Saida</label>
									<input class="form-control" name="datasaida" value="<?php echo $boleia->DATA_DE_PARTIDA?>">
								</div>
								
								<div class="form-group">
									<label>Data de chegada</label>
									<input class="form-control" name="datachegada" value="<?php echo $boleia->DATA_DE_CHEGADA?>">
								</div>
								<div class="form-group">
									<label>Lugares Disponíveis</label>
									<input type="number" class="form-control" name="lugares" value="<?php echo $boleia->LUGARES_DISPONIVEIS?>">
								</div>
							
                                    								
								<div class="form-group">
									<label>Estado</label>
									<input type="text" class="form-control" name="estado" value="<?php echo $boleia->ESTADO?>">
								</div>

								<div class="form-group">
									<label>Activo</label>
									<select class="form-control" name="activo">
										<option>0</option>
										<option>1</option>
									</select>
								</div>

								

								
								<button type="submit" class="btn btn-default">Alterar</button>
								<button type="reset" class="btn btn-default">Reiniciar formulário</button>
							</form>
							
							<?php endif; ?>
						</div>


				
							
						
						
					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url()?>assets/admin/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url()?>assets/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url()?>assets/admin/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url()?>assets/admin/vendor/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/vendor/morrisjs/morris.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url()?>assets/admin/js/sb-admin-2.js"></script>

</body>

</html>
