<?php $this->load->view('admin/includes/headerside'); ?>


 <!-- <tr class="odd gradeX">
        <td>Trident</td>
        <td>Internet Explorer 4.0</td>
        <td>Win 95+</td>
        <td class="center">4</td>
        <td class="center">X</td>
    </tr> -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestão</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Boleias
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID da boleia</th>
                                        <th>ID da Viatura</th>
                                        <th>Origem</th>
                                        <th>Destino</th>
                                        <th>Data de criação</th>
                                        <th>Data de partida</th>
                                        <th>Data de chegada</th>
                                        <th>Lugares disponíveis</th>
                                        <th>Estado da boleia</th>
                                        <th>Nome do Condutor</th>
                                        <th>Está activa?</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php foreach($boleias as $b):?>
                                     <tr>
                                        <td><?php echo $b->IDBOLEIA?></td>
                                        <td><?php echo $b->IDVIATURA?></td>
                                        <td><?php echo $b->ORIGEM?></td>
                                        <td><?php echo $b->DESTINO?></td>
                                        <td><?php echo $b->DATA_CRIACAO?></td>
                                        <td><?php echo $b->DATA_DE_PARTIDA?></td>
                                        <td><?php echo $b->DATA_DE_CHEGADA?></td>
                                        <td><?php echo $b->LUGARES_DISPONIVEIS?></td>
                                        <td><?php echo $b->ESTADO?></td>
                                        <td><?php echo $b->CONDUTOR?></td>
                                        <td><?php echo $b->Boleia_activa?></td>
                                        <td><a href="<?php echo base_url()?>index.php/admin/gestaoboleias/editar/<?php echo $b->IDBOLEIA?>">Editar</a></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
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

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
