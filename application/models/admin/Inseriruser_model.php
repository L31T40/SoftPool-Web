<?php

class Inseriruser_model extends CI_Model
{
	function numero_utilizador($id)
	{
		$this->db->select('*');
		$this->db->where('IDUTILIZADOR',$id);
		$user = $this->db->get('UTILIZADORES');

		return $user->row();
	}

	function numero_utilizador_ordenado()
	{
		$this->db->select('IDUTILIZADOR');
		$this->db->order_by('IDUTILIZADOR','DESC');
		$user = $this->db->get('UTILIZADORES');

		return $user->row()->IDUTILIZADOR;
	}

	function inserir($dados)
	{
		$this->db->insert('UTILIZADORES',$dados);

		return $this->db->affected_rows();

		// return 0;
	}

	function alterar($dados)
	{
		$this->db->where('IDUTILIZADOR',$this->input->post('iduser'));
		$this->db->update('UTILIZADORES',$dados);

		return $this->db->affected_rows();

		// return 0;
	}

	function locaisparaDropdown()
	{
		$this->db->select('IDLOCAL, NOME_CIDADE');
		$locais = $this->db->get('LOCAIS');

		return $locais;
	}

	function getids()
	{
		$this->db->select('IDUTILIZADOR, NOME');
		$users = $this->db->get('UTILIZADORES');

		return $users->result();
	}

}

?>