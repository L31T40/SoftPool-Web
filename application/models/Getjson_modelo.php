<?php
class Getjson_modelo extends CI_Model
{
	function devolve()
	{
		$this->db->select('*');
		$this->db->from('BOLEIAS');
		$result=$this->db->get();
		return $result->result();
	}
	
	function devolvetudo()
	{
		$comandos = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.NOME, FOTO FROM BOLEIAS JOIN UTILIZADORES_BOLEIA
			ON UTILIZADORES_BOLEIA.IDBOLEIA = BOLEIAS.IDBOLEIA JOIN UTILIZADORES ON (UTILIZADORES.IDUTILIZADOR = UTILIZADORES_BOLEIA.IDUTILIZADOR AND UTILIZADORES_BOLEIA.CONDUTOR = 1) JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO WHERE BOLEIAS.ACTIVO = 1');
		
		return $comandos->result();
	}
	
	function getbyid($id){
		$obterporid = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.IDUTILIZADOR, UTILIZADORES.NOME AS NOME_UTIL, E_MAIL, FOTO, IDAREA, TELEFONE, CONDUTOR FROM UTILIZADORES_BOLEIA AS UB JOIN BOLEIAS ON UB.IDBOLEIA = BOLEIAS.IDBOLEIA JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO WHERE UB.IDBOLEIA = ?',$id);
		
		return $obterporid->result();
	}
	
	function getbyidtemporario($id){
		$obterporid = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.IDUTILIZADOR, UTILIZADORES.NOME AS NOME_UTIL, E_MAIL, FOTO, IDAREA, TELEFONE, CONDUTOR FROM UTILIZADORES_BOLEIA AS UB JOIN BOLEIAS ON UB.IDBOLEIA = BOLEIAS.IDBOLEIA JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO WHERE UB.IDBOLEIA = ? AND UB.CONDUTOR =1',$id);
	 /*   
		print_r($obterporid->result());
		die();*/

		return $obterporid->result();
	}
	
	function cmp($a, $b)
	{
		return strcmp($a->DATA_DE_PARTIDA,$b->DATA_DE_PARTIDA);
	}
	
	function getbyUtilizador($utilizador)
	{
	 /*   $this->db->select('IDBOLEIA');
		$this->db->from('IDUTILIZADORBOLEIA');
		$this->db->where('IDUTILIZADOR',$utilizador);

		$utilizadores = $this->db->get('UTILIZADORES_BOLEIA');

		$utilizadores*/

		$this->db->select('IDBOLEIA');
		$this->db->from('UTILIZADORES_BOLEIA');
		$this->db->where('IDUTILIZADOR',$utilizador);
		$this->db->where('ACTIVO',1);
		$comandos = $this->db->get();

		
		$array=$comandos->result_array();
		$idsboleia = array_map (function($value){
			return $value['IDBOLEIA'];
		} , $array);

		$resultados = array();

		foreach($idsboleia as $idboleia)
		{
			$buffer = $this->db->query("SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, (LUGARES_DISPONIVEIS - (SELECT COUNT(*) FROM UTILIZADORES_BOLEIA WHERE ACTIVO = 1 AND CONDUTOR = 0 AND IDBOLEIA = $idboleia)) AS LUGARES_DISPONIVEIS, LUGARES_DISPONIVEIS AS LOTACAO, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.IDUTILIZADOR AS IDCONDUTOR,UTILIZADORES.NOME, FOTO FROM BOLEIAS JOIN UTILIZADORES_BOLEIA ON (UTILIZADORES_BOLEIA.IDBOLEIA = BOLEIAS.IDBOLEIA AND BOLEIAS.IDBOLEIA = $idboleia) JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UTILIZADORES_BOLEIA.IDUTILIZADOR
				JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM
				JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO
				WHERE UTILIZADORES_BOLEIA.CONDUTOR = 1 AND BOLEIAS.ACTIVO = 1");

			if($buffer->num_rows() != 0)
				$resultados[] = $buffer->row();



		}

		usort($resultados, "Getjson_modelo::cmp");

		return $resultados;


		
	}
	
	

	function getbyTudo()
	{
		
	}
	
	
	

	
	function getLocais() //cria json com os locais
	{
		$this->db->select('IDLOCAL, NOME_CIDADE');
		$this->db->from('LOCAIS');
		$this->db->order_by("NOME_CIDADE", "ASC");
		
		$resultado = $this->db->get();
		
		return $resultado->result();
	}
	
	function getCombustivel() //cria json com o combustivel
	{
		$this->db->select('IDCOMBUSTIVEL, COMBUSTIVEL');
		$this->db->from('COMBUSTIVEL');
		
		$resultado = $this->db->get();
		
		return $resultado->result();
	}
	
	
  //Pesquisa boleia a partir dos locais passados por parametro
	function PesquisaBoleiasLocaisData($dados)
	{
		$comandos = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, NOME, FOTO
			FROM BOLEIAS
			JOIN UTILIZADORES_BOLEIA AS UB
			ON (UB.IDBOLEIA = BOLEIAS.IDBOLEIA AND UB.CONDUTOR = 1)
			JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR JOIN (LOCAIS AS ORIG)
			ON (ORIG.IDLOCAL = BOLEIAS.ORIGEM AND ORIG.IDLOCAL = ?)
			JOIN (LOCAIS AS DESTIN) ON (DESTIN.IDLOCAL = BOLEIAS.DESTINO AND DESTIN.IDLOCAL = ?) WHERE DATE(DATA_DE_PARTIDA) = ?',array($dados['partida'],$dados['destino'],formatardata($dados['horario'])));
		
		return $comandos->result();
		
	}
	
	
	
	function PesquisaBoleiasLocais($dados)
	{

		/* caso
		0 - "em"
		1 - "ate" 
		2 - apos
		*/

		$tipodata = -1;
		$tipohora = -1;

		if(isset($dados['data']))
		{
			$data = $dados['data']; // data inicial, que passa por post
			$hora = $dados['hora'];
			$tipodata = $dados['tipodata'];
			$tipohora = $dados['tipohora'];
		}
		


		$utilizador = $dados['utilizador'];
		$_partida = '1 OR 1=1';
		$_destino = '1 OR 1=1';
		$dataactualpesquisar = "'2000-06-01 00:00'";
		$dataseguinte = "'2030-06-01 00:00'";
		
		if($dados['partida'] != '%20')
		{
			$_partida = "'".$dados['partida']."'";
		}
		
		if($dados['destino'] != '%20')
		{
			$_destino = "'".$dados['destino']."'";
		}
		

		if($tipodata == 0)  // em
		$str = " WHERE DATA_DE_PARTIDA = '$data'";
		elseif($tipodata == 1)    // até
		$str = " WHERE DATA_DE_PARTIDA < '$data'";
		elseif($tipodata == 2)    // após
		$str = " WHERE DATA_DE_PARTIDA > '$data'";
		else
			$str = '';

		if($tipohora == 0)  // em
		$str1 = " AND TIME(DATA_DE_PARTIDA) = '$hora'";
		elseif($tipohora == 1)    // até
		$str1 = " AND TIME(DATA_DE_PARTIDA) < '$hora'";
		elseif($tipohora == 2)    // após
		$str1 = " AND TIME(DATA_DE_PARTIDA) > '$hora'";
		else
			$str1 = '';


		
		
		$minhaquery =" SELECT BOLEIAS.IDBOLEIA,
		BOLEIAS.IDVIATURA,
		ORIG.NOME_CIDADE AS ORIGEM,
		DESTIN.NOME_CIDADE AS DESTINO,
		DATA_CRIACAO, DATA_DE_PARTIDA,
		DATA_DE_CHEGADA, LUGARES_DISPONIVEIS,
		OBJECTIVO_PESSOAL,
		ESTADO,
		NOME,
		FOTO
		FROM BOLEIAS
		JOIN UTILIZADORES_BOLEIA AS UB 
		ON (UB.IDBOLEIA = BOLEIAS.IDBOLEIA AND UB.CONDUTOR = 1 AND UB.IDUTILIZADOR <> $utilizador)
		JOIN UTILIZADORES 
		ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR
		JOIN (LOCAIS AS ORIG) 
		ON (ORIG.IDLOCAL = BOLEIAS.ORIGEM AND (ORIG.IDLOCAL = $_partida))
		JOIN (LOCAIS AS DESTIN) 
		ON (DESTIN.IDLOCAL = BOLEIAS.DESTINO AND (DESTIN.IDLOCAL = $_destino))".$str.$str1;
		

		$comandos = $this->db->query($minhaquery);
		return $comandos->result();
		
		

	}
	
		  //Pesquisa boleia a partir dos locais passados por parametro
	function PesquisaViaturasByUserID($id)
	{
		$comandos = $this->db->query('SELECT MATRICULA, IDVIATURA, MARCA, MODELO, SEGURO_CONTRA_TODOS_OS_RISCOS, ACTIVO, COMBUSTIVEL, LOTACAO, IDUTILIZADOR
			FROM VIATURAS
			JOIN COMBUSTIVEL ON VIATURAS.IDCOMBUSTIVEL = COMBUSTIVEL.IDCOMBUSTIVEL
			WHERE MATRICULA IN (SELECT DISTINCT MATRICULA FROM VIATURAS) AND (IDUTILIZADOR = ? OR IDUTILIZADOR = 10) AND ACTIVO=1',$id);

		return $comandos->result();
		
	}
	
	
	/*função obter o veículo através da matrícula*/
	function obterVeiculo($matricula)
	{
		$newviatura = $this->db->query('SELECT IDVIATURA FROM VIATURAS WHERE MATRICULA = ? LIMIT 1',$matricula);
		
		if($newviatura->num_rows() == 0)
		{
			return -1;
		}
		else
		{
			$viat = $newviatura->row();
			return $viat->IDVIATURA;
		}
	}
	
	
	
		 function getUserData($utilizador) //cria json dados do utilizador
		 {
		 	
		 	$comandos = $this->db->query(
		 		'SELECT UTILIZADORES.IDUTILIZADOR, NFUNCIONARIO, UTILIZADORES.NOME, UTILIZADORES.TELEFONE,
		 		UTILIZADORES.E_MAIL, LOCAIS.NOME_CIDADE, UTILIZADORES.FOTO
		 		FROM UTILIZADORES
		 		INNER JOIN LOCAIS ON LOCAIS.IDLOCAL = UTILIZADORES.IDAREA
		 		WHERE UTILIZADORES.NFUNCIONARIO = ?',$utilizador);
			 //WHERE UTILIZADORES.IDUTILIZADOR = ?',$utilizador);
		 	
		 	return $comandos->result();
		 }
		 
		 
		 function getbyIDpassageiros($idbleia)
		 {
		 	$comandos = $this->db->query('
		 		SELECT UTILIZADORES.IDUTILIZADOR, NFUNCIONARIO, NOME, TELEFONE, E_MAIL, LOCAIS.NOME_CIDADE, FOTO, UB.OBJECTIVO_PESSOAL
		 		FROM UTILIZADORES_BOLEIA AS UB
		 		JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR
		 		INNER JOIN LOCAIS ON LOCAIS.IDLOCAL = UTILIZADORES.IDAREA
		 		WHERE UB.ACTIVO = 1 AND UTILIZADORES.ACTIVO = 1 AND UB.CONDUTOR = 0 AND IDBOLEIA = ?',$idbleia);

		 	return $comandos->result();
		 	
		 	
		 }
		 
		 function getbyIDboleia($idboleia)
		 {
		 	$obterporid = $this->db->query('
		 		SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM,
		 		DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA,
		 		(LUGARES_DISPONIVEIS - (SELECT COUNT(*) FROM UTILIZADORES_BOLEIA WHERE ACTIVO = 1 AND IDBOLEIA = ? AND CONDUTOR = 0 )) AS LUGARES_DISPONIVEIS, LUGARES_DISPONIVEIS AS LOTACAO, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.IDUTILIZADOR,
		 		UTILIZADORES.NOME AS NOME_UTIL, E_MAIL, FOTO, IDAREA, TELEFONE, CONDUTOR
		 		FROM UTILIZADORES_BOLEIA AS UB
		 		JOIN BOLEIAS ON UB.IDBOLEIA = BOLEIAS.IDBOLEIA
		 		JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR
		 		JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM
		 		JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO
		 		WHERE UB.IDBOLEIA = ? AND UB.CONDUTOR = 1
		 		ORDER BY DATA_DE_PARTIDA ASC',array($idboleia,$idboleia));
		 	
		 	return $obterporid->result();  
		 	
		 }
		 
		 function getbyIDboleia_soUmaLinha($idbleia)
		 {
		 	$obterporid = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.IDUTILIZADOR, UTILIZADORES.NOME AS NOME_UTIL, E_MAIL, FOTO, IDAREA, TELEFONE, CONDUTOR FROM UTILIZADORES_BOLEIA AS UB JOIN BOLEIAS ON UB.IDBOLEIA = BOLEIAS.IDBOLEIA JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO WHERE UB.IDBOLEIA = ? AND UB.CONDUTOR = 1 LIMIT 1',$idbleia);
		 	
		 	return $obterporid->result();
		 	
		 	
		 }
		}
		
		?>