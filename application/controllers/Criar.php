<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Criar extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        
        /*if($_SESSION['is_logged_in'] != 1)
            redirect('ctrlogin/validardados');*/
	
        $this->load->model('Activas_modelo');
        $this->load->model('Criar_modelo');
    }
    
    public function verificarLocal()
    {
        $local = $_POST['locs'];
    
        $idlocal = $this->Criar_modelo->ConverterLocal($local);
        
        echo $idlocal;
        
        // Modelo devolve -1 caso local não exista na BD
    }
    
    public function inserirLocal()
    {
        /*Obtém uma string a partir da view principal, e cria uma nova entrada na base de dados de locais*/

        if(isset($_POST['loc']) && isset($_POST['latitud']) && isset($_POST['longitud']))
            $comandos = $this->Criar_modelo->addLocal();
        else
        {
            $comandos = -1;
        }
        
        if($comandos != -1)
        {
            echo $comandos;
        }
        else 
        {
            echo -1;
        }
    }

    public function obterVeiculoviaMatricula()
    {
		$matricula = $_POST['matricula'];
		
        $viatura = $this->Criar_modelo->obterVeiculo($matricula);
        
        echo $viatura;
        
        // Modelo devolve -1 caso viatura não exista na BD
    }
    

    public function inserirVeiculo()
    {
        /*Obtém uma matrícula a partir da view principal, e cria uma nova entrada na base de dados de veículos*/

        $dadosparacarregar = array( 
            'ACTIVO' => 1,
            'IDUTILIZADOR' => $_SESSION['no_utilizador'],
            'MARCA' => $_POST['cv_obtermarca'],
            'MODELO' => $_POST['cv_obtermodelo'],
            'MATRICULA' => $_POST['cv_obtermatricula'],
            'IDCOMBUSTIVEL' => $_POST['cv_obtercombustivel'],
            'SEGURO_CONTRA_TODOS_OS_RISCOS' => 0,
            'LOTACAO' => $_POST['cv_obterlotacao']
            );
        
        if(isset($_POST['cv_obterseguro']))
        {
            $dadosparacarregar['SEGURO_CONTRA_TODOS_OS_RISCOS'] = 1;
        }

        if(isset($_POST['cv_obterproprviatura']))
        {
            $dadosparacarregar['IDUTILIZADOR'] = 10;
        }
        
        $comandos = $this->Criar_modelo->addVeiculo($dadosparacarregar);
        
        echo $comandos;
        
        // Modelo devolve -1 caso viatura não tenha sido inserida na BD
        
    }

    public function NewRide()
    {             
        /*Carregar dados POST para um array*/
        
            $dadosparacarregar = array(
                'viatura' => $_POST["cb_obteridviatura"],
                'idorigem' => $_POST["cb_obteridpartida"],
                'iddestino' => $_POST["cb_obteriddestino"],
                'horaspartida' => $_POST["cb_obterhoraspartida"],
                'horasdestino' => $_POST["cb_obterhorasdestino"],
                'datapartida' => $_POST["cb_obterdata"],
                'lotacao' => $_POST["cb_obterlotacao"],
                'objectivo' => 0
            );
            
            if(isset($_POST["cb_obterobjectpessoal"]))
            {
                $dadosparacarregar['objectivo'] = 1;
            }

            $resultado = $this->Criar_modelo->criar($dadosparacarregar);


            if($resultado == 0)
            {
                $this->session->set_userdata('mensagem', 'Ocorreu um erro na inserção de boleia!');
                redirect('activas/pool');
            }
            else
            {
                $this->session->set_userdata('mensagem', 'Boleia inserida com sucesso');
                redirect('activas/pool');
            }
            
            
            
    }

        /*echo var_dump($_POST);*/

    
     public function inserirVeiculoAndroid() //recebe json da app móvel e insere na BD
    {
        
     
        $jsonstr = json_decode(file_get_contents('php://input'), true);

        $dados = array( 

            'ACTIVO' => 1,
            'IDUTILIZADOR' => $jsonstr['IDUTILIZADOR'],
            'MARCA' => $jsonstr['MARCA'],
            'MODELO' => $jsonstr['MODELO'],
            'MATRICULA' => $jsonstr['MATRICULA'],
            'LOTACAO' =>$jsonstr['LOTACAO'],
            'IDCOMBUSTIVEL' => $jsonstr['IDCOMBUSTIVEL'],
            'SEGURO_CONTRA_TODOS_OS_RISCOS' => $jsonstr['SEGURO_CONTRA_TODOS_OS_RISCOS'],     
            );
        $comandos = $this->Criar_modelo->addVeiculo($dados);   

    }
    
    
        public function criarBoleiaMobile()
    {             
                 
            /*$jsonnaodecodado='{"IDVIATURA":"1","ORIGEM":"58","DESTINO":"58","DATA_DE_PARTIDA":"2018-07-08 22:24:00","DATA_DE_CHEGADA":"2018-07-08 22:24:00","LUGARES_DISPONIVEIS":"1","OBJECTIVO_PESSOAL":"0","IDUTILIZADOR":"1"}';*/
            //$jsonstr = json_decode($jsonnaodecodado, true);
            
           $jsonstr = json_decode(file_get_contents('php://input'), true);

           $dadosboleia= array(  
                
                'IDVIATURA' => $jsonstr['IDVIATURA'],
                'ORIGEM' => $jsonstr['ORIGEM'],
                'DESTINO' => $jsonstr['DESTINO'],
                'DATA_DE_PARTIDA' => $jsonstr['DATA_DE_PARTIDA'],
                'DATA_DE_CHEGADA' => $jsonstr['DATA_DE_CHEGADA'],
                'LUGARES_DISPONIVEIS' => $jsonstr['LUGARES_DISPONIVEIS'],
                'OBJECTIVO_PESSOAL' => $jsonstr['OBJECTIVO_PESSOAL'],
                'IDUTILIZADOR' => $jsonstr['IDUTILIZADOR'],
            );
            
            $this->Criar_modelo->criarboleiamobile($dadosboleia);
            
            
    }
        
}






?>