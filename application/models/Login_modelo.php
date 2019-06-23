<?php
class Login_modelo extends CI_Model
{    
	function login()
	{
		$this->db->select('HASH');
		$this->db->where('NFUNCIONARIO',$_POST["_user"]);
		$hashacomparar = $this->db->get('UTILIZADORES');

		if($hashacomparar->num_rows() > 0)
			$autenticacao = password_verify($_POST['_password'],$hashacomparar->row()->HASH);
		else
			return NULL;

		if($autenticacao == TRUE)
		{

			$query = $this->db->query('SELECT IDUTILIZADOR, NFUNCIONARIO, NOME, UTILIZADORES.IDAREA, LOCAIS.NOME_CIDADE AS AREA, E_MAIL, TELEFONE, NIVEL_ACESSO FROM UTILIZADORES JOIN LOCAIS ON LOCAIS.IDLOCAL = UTILIZADORES.IDAREA WHERE NFUNCIONARIO = ?',$_POST["_user"]);

				return $query->row();
		
		}
		else
		{
			return NULL;	
		}

	
	}

	function introduzir_no_log($iduser)
	{
		$this->db->select('IDUSER,IPADDRESS');
		$this->db->where('IPADDRESS',$_SERVER['REMOTE_ADDR']);
		$this->db->where('IDUSER',$iduser);
		$verse_esta = $this->db->get('LOG_UTILIZADORES');



		if($verse_esta->num_rows() == 0)
		{
			$introduzir = array(
				'IDUSER' => $iduser,
				'IPADDRESS' => $_SERVER['REMOTE_ADDR']
			);

			$this->db->insert('LOG_UTILIZADORES',$introduzir);
		}
	}

	function verificar_log_anterior()
	{
		$end_ip = $_SERVER['REMOTE_ADDR'];

		$user = $this->db->query("SELECT NFUNCIONARIO AS IDUSER, FOTO FROM LOG_UTILIZADORES JOIN UTILIZADORES ON IDUSER = IDUTILIZADOR WHERE IPADDRESS = '$end_ip' ORDER BY IDLOG DESC");

		if($user->num_rows() > 0)
			return $user->row();
		else
			return '';
	}


/*	function geradordepasswordsencriptadas($dados,$user)
	{
		$this->db->set('HASH',password_hash($dados, PASSWORD_BCRYPT));
		$this->db->where('IDUTILIZADOR',$user);
		$this->db->update('UTILIZADORES');

		return $this->db->affected_rows();
	}*/

}
?>