<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensagens extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');

        $this->load->model('mensagens_modelo');
    
    }

    public function enviarMensagem()
    {
        if(isset($_POST["msg_obteridboleiamsg"]) && isset($_POST["msg_tipomsg"]) && isset($_POST["msg_caixamsg"]))
        {

            $resultado = $this->mensagens_modelo->envio();




        
          if($resultado == 0)
            {
                $this->session->set_userdata('mensagem', 'Não se encontra na boleia, ou ocorreu um erro no envio de mensagem.');
                redirect('activas/pool');
            }
            else
            {
                $this->session->set_userdata('mensagem', 'Mensagem enviada com sucesso.');
                redirect('activas/pool');
            }
        }
        else
        {
            $this->session->set_userdata('mensagem', 'Ocorreu um erro no envio de mensagem.');
                redirect('activas/pool');
        }
    }


    public function ObterMensagens_de_Todas_boleias()
    {
        $meuutil = $_SESSION["no_utilizador"];

    	$mens = $this->mensagens_modelo->ObterMensagens_de_Todas_boleiasss();

        if(!empty($mens))
        {

        	$str = '';

            foreach($mens as $n)
            {
                $str .= '<div class="card">';
                $str .= '<div class="card-header">';
                $str .= 'Boleia '.$n[0]->IDBOLEIA;
                $str .= '</div>';

                for($i = 0; $i<count($n); $i++)
                {
                    $m = $n[$i];

                    $str .= '<div class="card-body">';
                    $str .= '<h6 class="card-subtitle mb-2 text-muted ';

                    if($m->NUM_REMETENTE == $meuutil)
                        $str .= 'text-right">';
                    else
                        $str .= 'text-left">';

                    $str .= $m->REMETENTE.'' ;
                    $str .= '</h6>';   
                    $str .= '<p class="card-text ';

                    if($m->NUM_REMETENTE == $meuutil)
                        $str .= 'float-right">';
                    else
                        $str .= 'float-left">';

                    $str .= $m->MENSAGEM.'</p>';
                    $str .= '</div>';
                    
                }

                $str .= '</div>';
                    
            }

            echo $str;
        	
  
        }
        else
        {
            $str = '';
            $str .= '<div class="card">';
            $str .= '<div class="card-body">';
            $str .= '<p class="card-text float-left">Não existem mensagens para apresentar!</p>';
            $str .= '</div>';
            $str .= '</div>';

            echo $str;
        }



          
    }
    
      public function ObterMensagens_de_uma_Boleia($id)
    {
        $str = '';

        $meuutil = $_SESSION["no_utilizador"];

        $resultado = $this->mensagens_modelo->ObterMensagens_de_uma_Boleia($id);

        if($resultado->num_rows()==0)
        {
            $str .= '<div class="card">';
            $str .= '<div class="card-body">';
            $str .= '<p class="card-text float-left">Não existem mensagens para apresentar!</p>';
            $str .= '</div>';
            $str .= '</div>';

            echo $str;
        }
        else
        {
                $n = $resultado->result();

                $str .= '<div class="card">';
                $str .= '<div class="card-header">';
                $str .= 'Boleia '.$n[0]->IDBOLEIA;
                $str .= '</div>';

                foreach($resultado->result() as $m)
                {        

                    $str .= '<div class="card-body">';
                    $str .= '<h6 class="card-subtitle mb-2 text-muted ';

                    if($m->NUM_REMETENTE == $meuutil)
                        $str .= 'text-right">';
                    else
                        $str .= 'text-left">';

                    $str .= $m->REMETENTE.'' ;
                    $str .= '</h6>';   
                    $str .= '<p class="card-text ';

                    if($m->NUM_REMETENTE == $meuutil)
                        $str .= 'float-right">';
                    else
                        $str .= 'float-left">';

                    $str .= $m->MENSAGEM.'</p>';
                    $str .= '</div>';
                    
                

                    

                }
                
                $str .= '</div>';
            

            echo $str;
        }



          
    }
       
    

}