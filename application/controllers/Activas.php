<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Activas extends CI_Controller {
	public function __construct()
	{
		/* Load dos helpers e modelo */
		
		parent:: __construct();
		
		$this->load->helper('url');	
		
		/*if($_SESSION['is_logged_in'] != 1)
		redirect('ctrlogin/validardados');*/
		
		$this->load->helper('form');
		$this->load->model('Activas_modelo');
		
	}

	public function redirect_login()
	{
		if($_SESSION['nivel_acesso'] == 1)
			redirect('admin/adm/index');
		else
			redirect('activas/pool');
	}

	public function logoff()
	{
		if($_SESSION['is_logged_in'] == 1)
		{
			$_SESSION['is_logged_in'] = 0;
			unset($_SESSION);
			$this->session->sess_destroy();
			redirect('ctrlogin/validarDados');
		}
	}

	public function limparpost_e_reiniciar()
	{
		$_POST = array();
		redirect('activas/pool');
	}	
	

	public function pool()
	{             

		/* Caso existam variáveis passadas por post, executa pesquisa. Caso contrário, abre página resumo */
		
		if(!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] != 1)
			redirect('ctrlogin/validardados');

		
		$flag = 0;
		
		$dados = array(
			'partida' => '',
			'destino' => '',
			'horario' => ''
		);   

		
		if(isset($_POST["_partida"]) && $_POST["_partida"] != '')
		{
			$flag = 1;
			$dados['partida'] = $_POST["_partida"];
		}
		if(isset($_POST["_destino"]) && $_POST["_destino"] != '')
		{
			$flag = 1;
			$dados['destino'] = $_POST["_destino"];
		}
		if(isset($_POST["_horario"]) && $_POST["_horario"] != '')
		{
			$flag = 1;
			$dados['horario'] = $_POST["_horario"];
		}
		
		$udados=array(
			'pesquisa' => '',
			'list' => '',
			'user' => ''
		);
		
		if($flag===1)
		{
			$udados['pesquisa'] = $this->Activas_modelo->pesquisar($dados);     
		}
		
		$udados['list']= $this->Activas_modelo->aSairdeArea($_SESSION["idlocal"]); 

		$udados['user']= $this->Activas_modelo->devolverPorUtilizador($_SESSION["no_utilizador"]);
		
		$udados['combustivel']= $this->Activas_modelo->getCombustivel();

		$this->load->view('boleiasactivas',$udados);
		
	}
	
	public function autocomplet(){
		if (isset($_GET['term'])) {
			$rowesultado = $this->Activas_modelo->autocompletar_locais($_GET['term']);
			if (count($rowesultado) > 0) {
				foreach ($rowesultado as $ocorr)
					$arr_resultado[] = $ocorr->NOME_CIDADE;
				echo json_encode($arr_resultado);
			}
		}
	}
	
		public function autocomplet_marc(){
			if (isset($_GET['term'])) {
				$rowesultado = $this->Activas_modelo->autocompletar_marcas($_GET['term']);
				if (count($rowesultado) > 0) {
					foreach ($rowesultado as $ocorr)
						$arr_resultado[] = $ocorr->MARCA;
					echo json_encode($arr_resultado);
				}
			}
		}

		public function autocomplet_modl(){
			if (isset($_GET['term'])) {
				$rowesultado = $this->Activas_modelo->autocompletar_modelos($_GET['term']);
				if (count($rowesultado) > 0) {
					foreach ($rowesultado as $ocorr)
						$arr_resultado[] = $ocorr->MODELO;
					echo json_encode($arr_resultado);
				}
			}
		}

		public function autocomplet_matr(){
				if (isset($_GET['term'])) {
					$rowesultado = $this->Activas_modelo->autocompletar_matriculas($_GET['term']);
					if (count($rowesultado) > 0) {
						foreach ($rowesultado as $ocorr)
							$arr_resultado[] = $ocorr->MATRICULA;
						echo json_encode($arr_resultado);
					}
				}
			}


	public function SairBoleiaMobile()
    {             
                 
            /*$jsonnaodecodado='{"IDVIATURA":"1","ORIGEM":"58","DESTINO":"58","DATA_DE_PARTIDA":"2018-07-08 22:24:00","DATA_DE_CHEGADA":"2018-07-08 22:24:00","LUGARES_DISPONIVEIS":"1","OBJECTIVO_PESSOAL":"0","IDUTILIZADOR":"1"}';*/
            //$jsonstr = json_decode($jsonnaodecodado, true);
            //{"IDUTILIZADOR":"1","IDBOLEIA":"8"}
        
           $jsonstr = json_decode(file_get_contents('php://input'), true);

           $dadosboleia= array(  
                
                'IDBOLEIA' => $jsonstr['IDBOLEIA'],
                'IDUTILIZADOR' => $jsonstr['IDUTILIZADOR']
            );
            
           $this->load->model('Adicionaraboleia_modelo');

            $this->Adicionaraboleia_modelo->sairboleiamobile($dadosboleia);       
            
    }	

    public function filtrar()
    {

    }

	



	

	public function poolmobile()
	{
		echo "sucesso";
	}
	
	
	



}

?>