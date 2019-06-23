<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_insert extends CI_Controller
{

	public function __construct()
	{


		/*---*/
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('form_validation');


	}


	public function add()
	{
  /*      //if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{

			$validacoes = array(
				array(
					'field' => 'idarea',
                	'label' => 'ID do local de trabalho',
                	'rules' => 'required|integer'
				),
				array(
					'field' => 'nfunc',
                	'label' => 'Número de funcionário',
                	'rules' => 'required'
				),
				array(
					'field' => 'nomuser',
                	'label' => 'Nome do utilizador',
                	'rules' => 'required'
				),
				array(
					'field' => 'telf',
                	'label' => 'Telefone do utilizador',
                	'rules' => 'required'
				),
				array(
					'field' => 'email',
                	'label' => 'E-mail do funcionário',
                	'rules' => 'required'
				),
				array(
					'field' => 'caminhofoto',
                	'label' => 'Caminho da foto',
                	'rules' => 'required'
				)
			);


            //form validation
			$this->form_validation->set_rules($validacoes);
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');


            //if the form has passed through the validation
			if ($this->form_validation->run())
			{

				$dadosainserir = array(
					'IDAREA' => 'idarea',
					'NFUNCIONARIO' => 'nfunc',
					'NOME' => 'nomuser',
					'TELEFONE' => 'telf',
					'E_MAIL' => 'email',
					'FOTO' => 'caminhofoto'

				);
                //if the insert has returned true then we show the flash message
				if($this->manufacturers_model->store_manufacture($dadosainserir)){
					$data['flash_message'] = TRUE; 
				}else{
					$data['flash_message'] = FALSE; 
				}

			}

		}*/
        //load the view
		$this->load->view('inseriruser');  
	}       

    /**
    * Update item by his id
    * @return void
    */





}


?>