<?php

class Gestaoboleias_model extends CI_Model
{
	function getBoleias_c_condutor()
	{
		$boleias = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, NOME_ESTADO AS ESTADO, UTILIZADORES.NOME AS CONDUTOR, BOLEIAS.ACTIVO AS Boleia_activa
			FROM BOLEIAS JOIN UTILIZADORES_BOLEIA
				ON (UTILIZADORES_BOLEIA.IDBOLEIA = BOLEIAS.IDBOLEIA AND UTILIZADORES_BOLEIA.CONDUTOR = 1)
			JOIN UTILIZADORES
				ON (UTILIZADORES.IDUTILIZADOR = UTILIZADORES_BOLEIA.IDUTILIZADOR)
			JOIN (LOCAIS AS ORIG)
				ON (ORIG.IDLOCAL = BOLEIAS.ORIGEM)
			JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO
			JOIN ESTADO_BOLEIAS ON ID_ESTADO = BOLEIAS.ESTADO');

		return $boleias->result();
	}

	function getBoleias_do_dia()
	{
		$boleias = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, NOME_ESTADO AS ESTADO, UTILIZADORES.NOME AS CONDUTOR, BOLEIAS.ACTIVO AS Boleia_activa
			FROM BOLEIAS JOIN UTILIZADORES_BOLEIA
				ON (UTILIZADORES_BOLEIA.IDBOLEIA = BOLEIAS.IDBOLEIA AND UTILIZADORES_BOLEIA.CONDUTOR = 1)
			JOIN UTILIZADORES
				ON (UTILIZADORES.IDUTILIZADOR = UTILIZADORES_BOLEIA.IDUTILIZADOR)
			JOIN (LOCAIS AS ORIG)
				ON (ORIG.IDLOCAL = BOLEIAS.ORIGEM)
			JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO
			JOIN ESTADO_BOLEIAS ON ID_ESTADO = BOLEIAS.ESTADO
			WHERE DATA_DE_PARTIDA >= CURDATE() AND DATA_DE_PARTIDA < (CURDATE() + INTERVAL 1 DAY)');

		return $boleias->result();
	}

	function getBoleias_criadas_no_dia()
	{
		$boleias = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, NOME_ESTADO AS ESTADO, UTILIZADORES.NOME AS CONDUTOR, BOLEIAS.ACTIVO AS Boleia_activa
			FROM BOLEIAS JOIN UTILIZADORES_BOLEIA
				ON (UTILIZADORES_BOLEIA.IDBOLEIA = BOLEIAS.IDBOLEIA AND UTILIZADORES_BOLEIA.CONDUTOR = 1)
			JOIN UTILIZADORES
				ON (UTILIZADORES.IDUTILIZADOR = UTILIZADORES_BOLEIA.IDUTILIZADOR)
			JOIN (LOCAIS AS ORIG)
				ON (ORIG.IDLOCAL = BOLEIAS.ORIGEM)
			JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO
			JOIN ESTADO_BOLEIAS ON ID_ESTADO = BOLEIAS.ESTADO
			WHERE DATA_CRIACAO >= CURDATE() AND DATA_DE_PARTIDA < (CURDATE() + INTERVAL 1 DAY)');

		return $boleias->result();
	}

	function getBoleias_ID($id)
	{
		$boleias = $this->db->query('SELECT IDBOLEIA, IDVIATURA, ORIGEM, ORIG.NOME_CIDADE AS ORIGEM_NOME, DESTINO, DESTIN.NOME_CIDADE AS DESTINO_NOME, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, ESTADO, NOME_ESTADO, BOLEIAS.ACTIVO
FROM BOLEIAS
JOIN (
LOCAIS AS ORIG
) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM
JOIN (
LOCAIS AS DESTIN
) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO
JOIN ESTADO_BOLEIAS ON ID_ESTADO = BOLEIAS.ESTADO
WHERE IDBOLEIA =?',$id);

		return $boleias->row();
	}

	function editarboleia()
	{
		$array = array(
			'ORIGEM' => $_POST['idorigem'],
			'DESTINO' => $_POST['iddestino'],
			'DATA_DE_PARTIDA' => $_POST['datasaida'],
			'DATA_DE_CHEGADA' => $_POST['datachegada'],
			'LUGARES_DISPONIVEIS' => $_POST['lugares'],
			'ESTADO' => $_POST['estado'],
			'ACTIVO' => $_POST['activo']
		);

		$this->db->where('IDBOLEIA', $_POST['idboleia']);
		$this->db->update('BOLEIAS',$array);

	}


}

?>