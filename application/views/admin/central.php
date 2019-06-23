<?php $this->load->view('admin/includes/headerside'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Área Central</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>Novas Mensagens</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Boleias que sairão hoje
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="boleiasdehoje" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Data partida</th>
                                            <th>Data chegada</th>
                                            <th>Estado</th>
                                            <th>Condutor/Passageiro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($boleias as $b):?>
                                        <tr>
                                            <td><?php echo $b->IDBOLEIA?></td>
                                            <td><?php echo $b->DATA_DE_PARTIDA ?></td>
                                            <td><?php echo $b->DATA_DE_CHEGADA ?></td>
                                            <td><?php echo $b->NOME_ESTADO ?></td>
                                            <td><?php

                                            $condut = $b->CONDUTOR;

                                            if($condut == 1)
                                                echo "Condutor";
                                            else
                                                echo "Passageiro";?>

                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

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

    
    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/vendor/datatables-responsive/dataTables.responsive.js"></script>


    <script>
        
        $('#boleiasdehoje').DataTable({
                "info": false,
                "language": {
                    "emptyTable": "Não existem boleias para apresentar"
                }
            });


        

    </script>

</body>

</html>
