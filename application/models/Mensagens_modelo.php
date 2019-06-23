<?php
class Mensagens_modelo extends CI_Model
{

	

    function ObterMensagens_de_Todas_boleiasss()
    {
    	$util = $_SESSION["no_utilizador"];

    	$resultado = $this->db->query("SELECT DISTINCT MENSAGENS.IDBOLEIA FROM MENSAGENS JOIN UTILIZADORES_BOLEIA ON UTILIZADORES_BOLEIA.IDBOLEIA = MENSAGENS.IDBOLEIA WHERE UTILIZADORES_BOLEIA.IDUTILIZADOR = $util");

    	$array=$resultado->result_array();
		$idsboleia = array_map (function($value){
			return $value['IDBOLEIA'];
		} , $array);

    	$mensagens = array();


    	foreach($idsboleia as $r)
    	{

    		$buffer = $this->db->query("SELECT IDMENSAGEM, NOME AS REMETENTE, NFUNCIONARIO AS NUM_REMETENTE, DATA_ENVIO, MENSAGEM, TIPO_MSG, MENSAGENS.IDBOLEIA
			FROM MENSAGENS JOIN
			UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = MENSAGENS.REMETENTE
			WHERE MENSAGENS.IDBOLEIA = $r");

    	$mensagens[] = $buffer->result();
    	}

    	return $mensagens;
	}

	

	function ObterMensagens_de_uma_Boleia($id)
    {
    	$resultado = $this->db->query("SELECT IDMENSAGEM, NOME AS REMETENTE, NFUNCIONARIO AS NUM_REMETENTE, DATA_ENVIO, MENSAGEM, TIPO_MSG, MENSAGENS.IDBOLEIA
			FROM MENSAGENS JOIN
			UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = MENSAGENS.REMETENTE
			WHERE MENSAGENS.IDBOLEIA = $id");


    	return $resultado;
	}

    function envio()
    {
        $this->db->select('IDBOLEIA');
        $this->db->where('IDUTILIZADOR',$_SESSION['no_utilizador']);
        $teste = $this->db->get('UTILIZADORES_BOLEIA');

        if($teste->num_rows() == 0)
        {
            return 0;
        }
        else
        {

        $query = 'INSERT INTO MENSAGENS (REMETENTE, DATA_ENVIO, MENSAGEM, TIPO_MSG, IDBOLEIA) VALUES (';
        $query .= $_SESSION['no_utilizador'];
        $query .= ', NOW()';
        $query .= ', \''.$_POST["msg_caixamsg"].'\'';
        $query .= ', '.$_POST["msg_tipomsg"];
        $query .= ', '.$_POST["msg_obteridboleiamsg"].')';

        $this->db->query($query);

        return $this->db->affected_rows();
        }
    }
  
}
?>