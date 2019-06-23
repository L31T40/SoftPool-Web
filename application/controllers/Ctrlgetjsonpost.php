<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Ctrlgetjsonpost extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        
        if($_SESSION['is_logged_in'] != 1)
            redirect('ctrlogin/validardados');
	
        $this->load->model('Activas_modelo');
        $this->load->model('Criar_modelo');
    }

 public function inserirVeiculoAndroid()
    {
     
            
/*
        $this->db->where('id_utilizador', $data['id_utilizador']);
        if($this->db->update('utilizador_comlogin',$data)){
            
            $this->db->where('id_utilizador', $data['id_utilizador']);
            $data['cliente'] = $this->db->get('utilizador_comlogin')->result();
            $data = array(
                'id' => $data['cliente'][0]->id_utilizador,
                'nome' => $data['cliente'][0]->nome_u,
                'sobrenome' => $data['cliente'][0]->ultimo_u,
                'datainscricao' => $data['cliente'][0]->data_inscricao,
                'level' => $data['cliente'][0]->id_perfil,
                'contacto' => $data['cliente'][0]->contacto_u
            );
            echo json_encode($data); 
        }
           
        else
            echo 'Erro ao inserir os dados';*/
     
        /*Obtém uma matrícula a partir da view principal, e cria uma nova entrada na base de dados de veículos*/
         
         //$json=$_GET ['json'];
        $dadosparacarregar = json_decode(file_get_contents('php://input'), true);
        
        //echo $json;
       // $input_data = json_decode(trim(file_get_contents('php://input')), true);

        //print_r($json);
       // print_r("this is a test");
        
        $dadosparacarregar = array( 
            'ACTIVO' => 1,
            'IDUTILIZADOR' => $_SESSION['no_utilizador'],
            'MARCA' => $_POST['cv_marca'],
            'MODELO' => $_POST['cv_modelo'],
            'MATRICULA' => $_POST['cv_matricula'],
            'SEGURO_CONTRA_TODOS_OS_RISCOS' => 0
            );
        
        if(isset($_POST['cv_seguro']))
        {
            $dadosparacarregar['SEGURO_CONTRA_TODOS_OS_RISCOS'] = 1;
        }
        
        $comandos = $this->Criar_modelo->addVeiculo($dadosparacarregar);
        
        echo json_encode($data); 
        
        // Modelo devolve -1 caso viatura não tenha sido inserida na BD
        
    }
    
  /*  public function inserirVeiculoAndroid()
    {
        
         
         //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $dadosparacarregar = json_decode($json);
        //echo $json;
       // $input_data = json_decode(trim(file_get_contents('php://input')), true);

        print_r($json);
        print_r("this is a test");
        
        $dadosparacarregar = array( 
            'ACTIVO' => 1,
            'IDUTILIZADOR' => $_SESSION['no_utilizador'],
            'MARCA' => $_POST['cv_marca'],
            'MODELO' => $_POST['cv_modelo'],
            'MATRICULA' => $_POST['cv_matricula'],
            'SEGURO_CONTRA_TODOS_OS_RISCOS' => 0
            );
        
        if(isset($_POST['cv_seguro']))
        {
            $dadosparacarregar['SEGURO_CONTRA_TODOS_OS_RISCOS'] = 1;
        }
        
        $comandos = $this->Criar_modelo->addVeiculo($dadosparacarregar);
        
        echo $comandos;
        
        // Modelo devolve -1 caso viatura não tenha sido inserida na BD
        
    }*/
    
    
    
}

 
