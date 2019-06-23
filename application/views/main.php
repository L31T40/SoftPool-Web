<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Softpool - Login</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/dist/css/styles_login.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/css/bootstrap.css">
        
        <style>
            #map{
                height: 400px;
                width: 600px;
            }
        
        </style>
    </head>

    <body>

        <header>
            <section class="topo"></section>

            <section>
                <div class="softpool">
                </div>
                <div class="softpoolimg"><img src="<?php echo base_url()?>assets/imagens/softpool.png" alt="Ir para Home"></div> 

            </section>




        </header>


        <div class="container">

            <div class="row" id="pwd-container">
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-4"></div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-4 formlogin">
                    <div class="login-form">
                        <form method="post" action="<?php echo base_url()?>index.php/ctrlogin/validardados" role="login">
                            <div class="bemvindo">Bem Vindo</div>
                            <div class="imagemlogin">

                            <?php if(!empty($log_user)):?>
                               <img src="<?php echo base_url().'assets/fotos/'.$log_user->FOTO?>"> 

                            <?php else:?>
                                <img src="<?php echo base_url()?>assets/imagens/user.svg">

                            <?php endif; ?>

                            </div>


                            <input type="text" name="_user" placeholder="Utilizador" <?php if(!empty($log_user)) echo 'value='.$log_user->IDUSER;?> required class="form-control input-lg"  />


                            <input type="password" name="_password" class="form-control input-lg" id="password" placeholder="Password" required="required" />

                            <?php if ($this->session->flashdata('category_error')) { ?>
                                <div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
                            <?php } ?>
                            
                            <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">ENTRAR</button>

                            <ul class="esqueceu">
                                <li>Esqueceu o Utilizador / Password</li>
                                <li>Não tem conta? Se é colaborador peça um acesso</li>
                            </ul>

                        </form>

                    </div>

                    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-4"></div>


                </div>




            </div>


            
            










            <footer class="contentor2 flex2">
                <p>


                </p>
            </footer>


            </body>
        </html>