<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Obterflash extends CI_Controller {
	

	public function flash()
	{
		if($this->session->userdata('mensagem'))
		{
			echo $this->session->userdata('mensagem');
			$this->session->unset_userdata('mensagem');
		}
		else
			echo 0;

	}
	

}

?>