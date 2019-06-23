<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adicionaraboleia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        
        $this->load->model('Adicionaraboleia_modelo');
    }
    
    
    public function verificarlugares_e_seestainscrito()
    {
        $id = $_POST["idbleia"];
        $pessoal = $_POST["pessoall"];

        $passageiros = $this->Adicionaraboleia_modelo->nopassageiros_contar_e_obter($id);
        
        $no_de_passageiros_pessoais = $passageiros['nro_passageiros_pessoais'];
        $no_de_passageiros_profissionais = $passageiros['nro_passageiros_prof'];
        $no_de_passageiros = $no_de_passageiros_pessoais + $no_de_passageiros_profissionais;
        $lugaresdisp = $passageiros['lugares'];


        $vai = Adicionaraboleia::verificarsevainaboleia_aux($id);

        /* Se a boleia for pessoal, só testa se há lugar e se já está inscrito*/
        
        
            if($vai === -1)
            {
                echo -1;  // erro
            }
            else if($no_de_passageiros >= $lugaresdisp && $vai === 1)
            {
                echo 0;   // Não tem lugar e já se encontra na boleia
            }
            else if($no_de_passageiros >= $lugaresdisp && $vai === 0)
            {
                if($pessoal == 1)
                    echo 1; // Não tem lugar
                /* Se for profissional, pode fazer uma troca */
                else
                {
                    if($no_de_passageiros_pessoais > 0)
                        echo 4;
                    else
                        echo 1;
                }
            }
            else if($no_de_passageiros < $lugaresdisp && $vai === 1)
            {
                echo 2; // Já vai na boleia
            }
            else
            {
                echo 3; //Tudo ok.
            }
        
        /* Se for profissional, pode ter que trocar com pessoal*/
        /*else
        {
            if($vai === -1)
            {
                echo -1;  // erro
            }
            else if($no_de_passageiros - 1 >= $lugaresdisp && $vai === 1)
            {
                echo 0;   // Não tem lugar e já se encontra na boleia
            }
            else if($no_de_passageiros -1 >= $lugaresdisp && $vai === 0)
            {
                if($no_de_passageiros_pessoais == 0)
                    echo 1; // Não tem lugar e não pode trocar
                else
                    echo 4; // Não tem lugar, mas pode trocar
            }
            else if($no_de_passageiros -1 < $lugaresdisp && $vai === 1)
            {
                echo 2; // Já vai na boleia
            }
            else
            {
                echo 3; //Tudo ok.
            }
        }*/

       
        
    }
    
    public function verificarsevainaboleia_aux($id)
    {
        $vai = $this->Adicionaraboleia_modelo->verificarsevai($id);
        
        if($vai === 0)
        {
            return 0; // nao vai na boleia;
        }
        else if($vai === -1)
        {
            return -1; // erro
        }
        else
        {
            return 1; // vai na boleia
        }
        
        
    }

    public function verificarsevainaboleia($id)
    {
        $vai = $this->Adicionaraboleia_modelo->verificarsevai($id);
        
        if($vai === 0)
        {
            echo 0;
        }
        else
        {
            echo $vai;
        }
        
        
    }
    
    public function adicionar()
    {
        $id = $_POST["idbleia"];
        $pessoal = $_POST["pessoall"];

        $funcionou = $this->Adicionaraboleia_modelo->acrescentarpassageiro($id,$pessoal);
        
        if($funcionou === 1)
        { 
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    
    public function adicionarMobile()
    {
        
        //$cenas= '{"IDBOLEIA":"15","IDUTILIZADOR":"1","OBJETIVO":"0"}'  ; 
        $jsonstr = json_decode(file_get_contents('php://input'), true);
       // $jsonstr = json_decode($cenas, true);
        
        $id = $jsonstr['IDBOLEIA'];
        $pessoal = $jsonstr['OBJETIVO'];
        $utilizador = $jsonstr['IDUTILIZADOR']; // colocar jsonstr

        $funcionou = $this->Adicionaraboleia_modelo->acrescentarpassageiroMobile($id,$pessoal,$utilizador);
        
    }


    public function adicionar_profissional_com_troca($id)
    {
        /* Caso seja profissional, vai fazer uma verificação se existe algum pessoal com que possa trocar. Pessoal passa para UTILIZADOR_BOLEIA_FILA */
        $funcionou = $this->Adicionaraboleia_modelo->acrescentarpassageiro_comtroca($id);
        
        if($funcionou === 1)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }


    
    public function cancelar($idutilizadorboleia)
    {
        $funcionou = $this->Adicionaraboleia_modelo->removerpassageiro($idutilizadorboleia);
        
        if($funcionou === 1)
        {
            echo 1;     // sucesso
        }
        else if($funcionou === -1)
        {
            echo -1;    // está a tentar remover o condutor
        }
        else
        {
            echo 0;     // erro
        }
        
    }
    
    

}