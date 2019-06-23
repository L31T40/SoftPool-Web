<?php $this->load->view('admin/includes/headerside'); ?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Inserir utilizador</h1>
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
							<?php echo form_open_multipart('admin/inseriruser/index');?>
								<div class="form-group">
									<label>Utilizador a inserir</label>
									<input class="form-control" name="iduser" value="<?php echo $newuser?>" readonly>
								</div>
								<div class="form-group">
									<label>Nome do utilizador</label>
									<input class="form-control" placeholder="Nome" name="nomuser">
								</div>
								<div class="form-group">
									<label>Número de funcionário</label>
									<input class="form-control" placeholder="Número" name="nfunc">
								</div>
								<div class="form-group">
									<label>Local de trabalho</label>
									<select class="form-control" name="idarea">
										<?php foreach($locais->result() as $linha): ?>
										<option value="<?php echo $linha->IDLOCAL?>"><?php echo $linha->NOME_CIDADE?></option>
									<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" placeholder="Password" name="pass_word" type="password" value="">
                                </div>
                                <div class="form-group">
									<label>Confirmar password</label>
									<input class="form-control" placeholder="Repetir password" name="confpass_word" type="password" value="">
                                </div>
                                    								
								<div class="form-group">
									<label>Telefone</label>
									<input class="form-control" placeholder="Número de telefone" name="telf">
								</div>

								<div class="form-group">
									<label>E-mail do utilizador</label>
									<input class="form-control" placeholder="E-mail" name="email" type="email">
								</div>

								<div class="form-group">
									<label>Foto para upload</label>
									<input type="file" name="userfoto">
								</div>
								
								<button type="submit" class="btn btn-default">Inserir</button>
								<button type="reset" class="btn btn-default">Reiniciar formulário</button>
							</form>
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
