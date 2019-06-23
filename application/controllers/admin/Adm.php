<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm extends CI_Controller {

	public function index()
	{
		$this->load->library('session');

		$this->load->helper('url');

		$this->load->model('admin/gestaoboleias_model');

		if(!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] != 1)
		redirect('ctrlogin/validardados');


		$dados["boleias"] = $this->gestaoboleias_model->getBoleias_do_dia();

		$dados["boleias_cr_no_dia"] = $this->gestaoboleias_model->getBoleias_criadas_no_dia();

	
		$this->load->helper('url');

		$dados["nome_do_site"] = 'Área Central';
		
		$this->load->view('admin/central',$dados);
	}
}
