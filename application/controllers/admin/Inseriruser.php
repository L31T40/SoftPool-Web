<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inseriruser extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

		$this->load->helper('form');
		
		$this->load->library('form_validation');

		$this->load->model('admin/inseriruser_model');
        $this->load->library('upload');
	}

	public function index()
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{

			$validacoes = array(
				array(
					'field' => 'nomuser',
                	'label' => 'Nome do utilizador',
                	'rules' => 'required'
				),
				array(
					'field' => 'nfunc',
                	'label' => 'Número de funcionário',
                	'rules' => 'required'
				),
				array(
					'field' => 'idarea',
                	'label' => 'ID do local de trabalho',
                	'rules' => 'required|integer'
				),
				array(
					'field' => 'pass_word',
                	'label' => 'Password',
                	'rules' => 'required'
				),
				array(
					'field' => 'confpass_word',
					'label' => 'Password de confirmação',
					'rules' => 'required|matches[pass_word]'
				),				
				array(
					'field' => 'telf',
                	'label' => 'Telefone do utilizador',
                	'rules' => 'required'
				),
				array(
					'field' => 'email',
                	'label' => 'E-mail do utilizador',
                	'rules' => 'required'
				),
				
			);


			$this->form_validation->set_rules($validacoes);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');



			if ($this->form_validation->run()==FALSE)
			{
				$data["nome_do_site"] = 'Inserir utilizador';

				$data['newuser'] = $this->inseriruser_model->numero_utilizador_ordenado();

				$data['locais'] = $this->inseriruser_model->locaisparaDropdown();

				$this->load->view('admin/insertuser',$data);
			}
			else
			{
				$foto = $this->upload();

			
				$dadosainserir = array(
					'IDAREA' => $this->input->post('idarea'),
					'NFUNCIONARIO' => $this->input->post('nfunc'),
					'NOME' => $this->input->post('nomuser'),
					'TELEFONE' => $this->input->post('telf'),
					'E_MAIL' => $this->input->post('email'),
					'FOTO' => $foto,
					'NIVEL_ACESSO' => 2,
					'HASH' => password_hash($this->input->post('pass_word'), PASSWORD_BCRYPT),
					'ACTIVO' => 1
				);
                
				$insercao = $this->inseriruser_model->inserir($dadosainserir);

				if($insercao == 1)
				{
					$this->session->set_flashdata('category_success', 'Utilizador inserido com sucesso.');
					redirect('admin/Inseriruser/index');
				}
				else
				{
					$this->session->set_flashdata('category_error', 'Erro na inserção do utilizador');
					redirect('admin/Inseriruser/index');
				}

			}

		}
		else
		{
			$utilizadorainserir = $this->inseriruser_model->numero_utilizador_ordenado();

			$utilizadorainserir += 1;

			$data["nome_do_site"] = 'Inserir utilizador';

			$data['newuser'] = $utilizadorainserir;

			$data['locais'] = $this->inseriruser_model->locaisparaDropdown();

			$this->load->view('admin/insertuser',$data);
		}
		
		
	}

	public function upload()
	{
        
                 
		$id = $this->input->post('iduser');
        
		$config['upload_path'] =  APPPATH."../assets/fotos/";
       
		$config['allowed_types'] = "gif|jpg|png";
		$filename = $_FILES['userfoto']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$config['file_name'] = $id.'.'.$ext;
		$config['upload_tmp_dir'] = sys_get_temp_dir();
		$config['overwrite'] = TRUE;
		$config['max_size'] = "2048000";
        
        
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('userfoto'))
        {
             $data = array('upload_data' => $this->upload->data());
            return $nomeficheiro['file_name'];

        
        }
		
	}
        
        

	public function escolheredit()
	{

	}

	public function editar()
	{
		

			$validacoes = array(
				array(
					'field' => 'nomuser',
                	'label' => 'Nome do utilizador',
                	'rules' => 'required'
				),
				array(
					'field' => 'nfunc',
                	'label' => 'Número de funcionário',
                	'rules' => 'required'
				),
				array(
					'field' => 'idarea',
                	'label' => 'ID do local de trabalho',
                	'rules' => 'required|integer'
				),
				array(
					'field' => 'telf',
                	'label' => 'Telefone do utilizador',
                	'rules' => 'required'
				),
				array(
					'field' => 'email',
                	'label' => 'E-mail do utilizador',
                	'rules' => 'required'
				),
				
			);


			$this->form_validation->set_rules($validacoes);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');



			if ($this->form_validation->run()==FALSE)
			{
				if(isset($_GET['escolhauser']))
				{
					$id = $_GET['escolhauser'];

					$data['utilizador'] = $this->inseriruser_model->numero_utilizador($id);

					$data['locais'] = $this->inseriruser_model->locaisparaDropdown();
				}
				else
				{
					$data['userlist'] = $this->inseriruser_model->getids();
				}
				
				$data["nome_do_site"] = 'Editar utilizador';
				
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
			}

		
	}


}