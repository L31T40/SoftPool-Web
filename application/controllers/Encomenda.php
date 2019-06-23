<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Encomenda extends CI_Controller {
	public function __construct()
	{
		/* Load dos helpers e modelo */
		
		parent:: __construct();
		
		$this->load->helper('url');	
		
		/*if($_SESSION['is_logged_in'] != 1)
		redirect('ctrlogin/validardados');*/
		
		$this->load->helper('form');
		$this->load->model('Encomenda_modelo');
		
	}

	public function obterNomeUtil($id)
	{
		$this->db->select('NOME');
		$this->db->where('NFUNCIONARIO',$id);
		$nome = $this->db->get('UTILIZADORES');

		if($nome->num_rows()>0)
			echo $nome->row()->NOME;
		else
			echo 'Não encontrado';
	}

	public function obterNumeroFunc()
	{
		$nome = $_POST['nomefunc'];

		$this->db->select('NFUNCIONARIO');
		$this->db->like('NOME',$nome);
		$id = $this->db->get('UTILIZADORES');

		if($id->num_rows()>0)
			echo $id->row()->NFUNCIONARIO;
		else
			echo 'Não encontrado';
	}

	public function inserirEncomenda()
	{

		$dadosparaencomenda = array(
			'IDBOLEIA' => $_POST["enc_idboleia"],
			'DESCRICAO_ENCOMENDA' => $_POST["enc_DescEncom"]
		);

		$idinserido = $this->Encomenda_modelo->criarEncomenda($dadosparaencomenda);

		if($idinserido == -1)
		{
			$this->session->set_userdata('mensagem', 'Ocorreu um erro na inserção de encomenda!');
            redirect('activas/pool');
		}

		$this->db->select('IDUTILIZADOR');
		$this->db->where('NFUNCIONARIO',$_POST['enc_getEmpregado']);
		$util = $this->db->get('UTILIZADORES');

		if($util->num_rows() == 0)
		{
			$this->session->set_userdata('mensagem', 'Ocorreu um erro na inserção de encomenda!');
            redirect('activas/pool');
		}

		$dadosparautilizadorencomenda = array(
			'IDENCOMENDA' => $idinserido,
			'IDREMETENTE' => $_SESSION['no_utilizador'],
			'IDDESTINATARIO' => $util->row()->IDUTILIZADOR
		);

		$idinserido2 = $this->Encomenda_modelo->criarassocUtilizadorEncomenda($dadosparautilizadorencomenda);

		if($idinserido == -1)
		{
			$this->session->set_userdata('mensagem', 'Ocorreu um erro na inserção de encomenda!');
            redirect('activas/pool');
		}
		else
		{
			$this->session->set_userdata('mensagem', 'Encomenda inserida com sucesso!');
            redirect('activas/pool');
		}



	}


    public function obterencomenda($id)
    {
    	$this->load->model('Activas_modelo');
        $bagagem = $this->Activas_modelo->getbyIDbagagem($id);

        $str = '';
        $str .= '<div class="enc_header">';
        $str .= '<div class="enc_headertexto">Encomenda</div>';
        $str .= '</div>';
        $str .= '<div class="enc_dados">';
        $str .= '<div class="enc_user">';
        $str .= '<div class="imagemlogin enc_margin"><img src="'.base_url().'assets/imagens/user.png"></div>';
        $str .= '<div class="imagemlogin enc_margin2"><img src="'.base_url().'assets/imagens/user.png"></div>';
        $str .= '</div>';
        $str .= '<div class="enc_form">';
      /*  $str .= '<input type="text" class="" id="idboleiaenc_show" name="enc_idboleia" readonly>';*/
        $str .= '<div class="enc_destinatario">Remetente</div>';
        $str .= '<div class="enc_nempregado">';
        $str .= '<input type="text" placeholder="Nº Empregado..." name="enc_getEmpregado" id="encid_remetente" size="13" value="'.$bagagem->IDREMETENT.'" readonly>';
        $str .= '</div>';
        $str .= '<div class="enc_nomempregado">';
        $str .= '<input type="text" placeholder="Nome..." size="48" name="enc_getNomeEmpregado" id="encid_getNomeEmpregado_show" value="'.$bagagem->REMETENTE.'" readonly>';
        $str .= '</div>';
        $str .= '<div class="enc_destinatario">Destinatário</div>';
        $str .= '<div class="enc_nempregado">';
        $str .= '<input type="text" placeholder="Nº Empregado..." name="enc_getEmpregado" id="encid_getEmpregado" size="13" value="'.$bagagem->IDDESTINATAR.'" readonly>';
        $str .= '</div>';
        $str .= '<div class="enc_nomempregado">';
        $str .= '<input type="text" placeholder="Nome..." size="48" name="enc_getNomeEmpregado" id="encid_getNomeEmpregado_show" value="'.$bagagem->DESTINATARIO.'" readonly>';
        $str .= '</div>';
        $str .= '<textarea id="encid_descricao_show" placeholder="Descrição da Encomenda..." class="enc_descrip" rows="4" cols="50" name="enc_DescEncom" readonly>'.$bagagem->DESCRICAO_ENCOMENDA.'</textarea>';
        $str .= '</div>';
        $str .= '</div>';

        echo $str;
    }


	



}

?>