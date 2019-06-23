<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ctrlogin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper(array('form', 'url'));	
        $this->load->model('Login_modelo');
    }
    
/*    public function gerador()
    {
        $pass = '@pDpdm&1b';
        $user = 1;

        $lindo = $this->Login_modelo->geradordepasswordsencriptadas($pass,$user);

        echo $lindo;
    }*/

    public function validarDados()
    {
        /* se utilizador já fez o login */
        if(isset($_SESSION['is_logged_in']))
        {
            if($_SESSION['is_logged_in'] == 1)
                redirect('activas/pool');
            else
            {
                $dados = array();
                $dados['log_user'] = $this->Login_modelo->verificar_log_anterior();
                $this->load->view('main',$dados);
            }
        }
        /* se utilizador não fez o login */
        else
        {
            /* já deu entrada dos dados */
            if(isset($_POST["_user"]) && isset($_POST['_password']))
            {
                $resultado = $this->Login_modelo->login();
        
                /* entrada do utilizador validada*/
                if($resultado)
                {
                    $this->Login_modelo->introduzir_no_log($resultado->IDUTILIZADOR);
                    $_SESSION["no_utilizador"] = $resultado->IDUTILIZADOR;
                    $_SESSION["nivel_acesso"] = $resultado->NIVEL_ACESSO;
                    $_SESSION["idlocal"] = $resultado->IDAREA;
                    $_SESSION["local"] = $resultado->AREA;
                    $_SESSION["is_logged_in"] = 1;
                    redirect('Activas/redirect_login');
                }
                /* entrada do utilizador não validada */
                else
                {
                    $dados = array();
                    $this->session->set_flashdata('category_error', 'Utilizador ou password incorrectos');
                    $this->load->view('main',$dados);
                }
                
            }
            /* não deu entrada dos dados */
            else
            {
                $dados = array();
                $dados['log_user'] = $this->Login_modelo->verificar_log_anterior();
                $this->load->view('main',$dados);
            }
       }
            
            
      
    }
    
    public function validarDadosMobile()
    {
        /*$dados = array(
            'utilizador' => $_POST["_user"],
            'password' => $_POST["_password"]
                );*/
        
        
        $resultado = $this->Login_modelo->login(/*$dados*/);
        
        if($resultado != FALSE){
            redirect('Activas/poolmobile');
        }else{
            echo "Login Invalido";
        }        
    }
    
}

?>