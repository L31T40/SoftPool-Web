    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getjson extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
		$this->load->model('Getjson_modelo');
        
    }
    
    
  function boleiasall()
  {

        $myJSONString = json_encode($this->Getjson_modelo->devolvetudo());
        echo JSON.stringify($myJSONString);
  }
    
    
  function getid()
  {
        $id = $this->uri->segment(3);
        $myJSONString = json_encode($this->Getjson_modelo->getbyidtemporario($id));
        echo $myJSONString;
  }
    
  /*  function get()
  {
        $fromeee = $this->uri->segment(3);
        $myJSONString = json_encode($this->Getjson_modelo->getbypedido($fromeee));
        echo $myJSONString;
  }*/
    

    
    function getuser() //retorna dados sobre utilizador
    {
        $utilizador = $this->uri->segment(3);
        
        $myJSONString = json_encode($this->Getjson_modelo->getbyUtilizador($utilizador));
        echo $myJSONString;
    }
    
    function gettudo()
    {
        $tudo = json_encode($this->Getjson_modelo->getbyTudo());
        echo $tudo;
    }
    
    
    function getUserData($utilizador)
        
    {
        $id = $this->uri->segment(3);
        $myJSONString = json_encode($this->Getjson_modelo->getuserdata($id));
        echo $myJSONString;
    }
    
    
    function getLocais()
        
    {
        
        $locais = json_encode($this->Getjson_modelo->getLocais());
        echo $locais;
    }
    
    function PesquisaBoleiasLocaisData()
    {
        $varspesquisa = array(
            'partida' => $this->uri->segment(3),
            'destino' => $this->uri->segment(4),
            'horario' => $this->uri->segment(5)/*,
            'utilizador' => $this->uri->segment(6)*/
            );
            
        $myJSONString = json_encode($this->Getjson_modelo->PesquisaBoleiasLocaisData($varspesquisa));
        echo $myJSONString;
    }
    
    
    function PesquisaBoleiasLocais()
    {
        

        /* Os argumentos de pesquisa entram através do url. Por exemplo, para pesquisar boleias do utilizador 7, do local 2 para o local 3, utiliza-se o url:

        http://193.137.7.33/~estgv16287/index.php/getjson/PesquisaBoleiasLocais/7/2/3/ */



        $varspesquisa = array(
            'utilizador' => $this->uri->segment(3),
            'partida' => $this->uri->segment(4),
            'destino' => $this->uri->segment(5)
            );
        

        /* Caso entrem mais que 3 argumentos, o controlador assume que foi dada uma data e uma hora. Assim, com o mesmo percurso apresentado acima, mas a partir do dia 13/07/2018 às 00:27, entra da seguinte forma:

        http://193.137.7.33/~estgv16287/index.php/getjson/PesquisaBoleiasLocais/7/2/3/20180713/2/0032/2/
         */         


        if($this->uri->segment(7)!==null)
        {
            $data_sem_tracos = $this->uri->segment(6);

            $data = substr($data_sem_tracos,0,4).'-'.substr($data_sem_tracos,4,2).'-'.substr($data_sem_tracos,6,2);


            $hora_sem_pontos = $this->uri->segment(8);

            $hora = substr($hora_sem_pontos,0,2).':'.substr($hora_sem_pontos,2,2);


            $varspesquisa['data'] = $data;
            $varspesquisa['tipodata'] = $this->uri->segment(7);
            $varspesquisa['hora'] = $hora;
            $varspesquisa['tipohora'] = $this->uri->segment(9);
        }


        $myJSONString = json_encode($this->Getjson_modelo->PesquisaBoleiasLocais($varspesquisa));
        echo $myJSONString;
    }


    /*Versão anterior, sem os filtros*/
        /*function PesquisaBoleiasLocais()
    {
        
        
        $varspesquisa = array(
            'partida' => $this->uri->segment(3),
            'destino' => $this->uri->segment(4),
            'horario' => $this->uri->segment(5)
            );
            
        $myJSONString = json_encode($this->Getjson_modelo->PesquisaBoleiasLocais($varspesquisa));
        echo $myJSONString;
    }*/
    
    /*função obter o veículo através da matrícula*/
    public function obterVeiculoviaMatricula($matricula)
    {
        $viatura = $this->Criar_modelo->obterVeiculo($matricula);
        
        echo $viatura;
        
        // se devolver "erro", tratar como erro
    }
    
   
    
    function pesquisaViaturasByUserID($id)
    
    {
        $id = $this->uri->segment(3);
        $myJSONString = json_encode($this->Getjson_modelo->pesquisaviaturasbyuserid($id));
        echo $myJSONString;
    }
    

      function getCombustivel()
        
    {
        
        $locais = json_encode($this->Getjson_modelo->getCombustivel());
        echo $locais;
    }  
    
    
    
    
    
      public function getBoleiaByid($id)
    {
        
        $id = $this->uri->segment(3);
        $myJSONString = json_encode($this->Getjson_modelo->getbyIDboleia($id));
        echo $myJSONString;
        
       // $detalhdados["boleia"] = $this->Activas_modelo->getbyIDboleia_soUmaLinha($id);
         

    } 
    
    public function getPassageirosBoleia($id)
    {
        

        
        /*$detalhdados["boleia"] = $this->Getjson_modelo->getbyIDboleia_soUmaLinha($id);*/
        
        $detalhdados = $this->Getjson_modelo->getbyIDpassageiros($id);
        
        $myJSONString = json_encode($detalhdados);

        echo $myJSONString;

    }
    

    
    
}
