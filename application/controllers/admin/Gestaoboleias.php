<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestaoboleias extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

		$this->load->model('admin/Gestaoboleias_model');

		$this->load->model('admin/inseriruser_model');

		$this->load->library('form_validation');
	}

	public function gestao()
	{

		$dados["boleias"] = $this->Gestaoboleias_model->getBoleias_c_condutor();

		$dados["nome_do_site"] = 'Gestão de Boleias';

		$this->load->view('admin/gereboleias',$dados);
	}


 
    public function editar()
	{
		$dados["nome_do_site"] = 'Editar boleia';
		

			$validacoes = array(
				array(
					'field' => 'idorigem',
                	'label' => 'Origem',
                	'rules' => 'required'
				),
				array(
					'field' => 'iddestino',
                	'label' => 'Destino',
                	'rules' => 'required'
				),
				array(
					'field' => 'datasaida',
                	'label' => 'Data de Saida',
                	'rules' => 'required'
				),
				array(
					'field' => 'datachegada',
                	'label' => 'Data de Chegada',
                	'rules' => 'required'
				),
				array(
					'field' => 'lugares',
                	'label' => 'Lugares Disponíveis',
                	'rules' => 'required'
				),
				array(
					'field' => 'estado',
                	'label' => 'Estado da Boleia',
                	'rules' => 'required'
				),
				
			);

			$this->form_validation->set_rules($validacoes);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');


			if ($this->form_validation->run()==FALSE)
			{
				$id = $this->uri->segment(4);

				$data['boleia'] = $this->Gestaoboleias_model->getBoleias_ID($id);

				$data['locais'] = $this->inseriruser_model->locaisparaDropdown();

				$this->load->view('admin/editboleias',$data);
			}	
			else
			{
				$this->Gestaoboleias_model->editarboleia();
			}
				




				/*$data["nome_do_site"] = 'Editar utilizador';
				
				$this->load->view('admin/edituser',$data);
			}
			else
			{
				$dadosaalterar = array(
					'IDAREA' => $this->input->post('idarea'),
					'NFUNCIONARIO' => $this->input->post('nfunc'),
					'NOME' => $this->input->post('nomuser'),
					'TELEFONE' => $this->input->post('telf'),
					'E_MAIL' => $this->input->post('email')
				);
                
				$insercao = $this->inseriruser_model->alterar($dadosaalterar);

				if($insercao == 1)
				{
					$this->session->set_flashdata('category_success', 'Utilizador alterado com sucesso.');
					redirect('admin/Inseriruser/editar');
				}
				else
				{
					$this->session->set_flashdata('category_error', 'Erro na alteração do utilizador');
					redirect('admin/Inseriruser/editar');
				}
			}*/

		
	}
    
}