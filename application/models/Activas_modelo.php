<?php
class Activas_modelo extends CI_Model
{
    function autocompletar_locais($local)
    {
        $this->db->like('NOME_CIDADE',$local,'both');
        $this->db->order_by('NOME_CIDADE','ASC');
        $this->db->limit(10);
        $comandos = $this->db->get('LOCAIS');
        
        return $comandos->result();
    }

     function autocompletar_marcas($marca)
    {
        $this->db->distinct();
        $this->db->select('MARCA');
        $this->db->like('MARCA',$marca,'both');
        $this->db->order_by('MARCA','ASC');
        $this->db->limit(10);
        $comandos = $this->db->get('VIATURAS');
        
        return $comandos->result();
    }

    function autocompletar_modelos($modelo)
    {
        $this->db->distinct();
        $this->db->select('MODELO');
        $this->db->like('MODELO',$modelo,'both');
        $this->db->order_by('MODELO','ASC');
        $this->db->limit(10);
        $comandos = $this->db->get('VIATURAS');
        
        return $comandos->result();
    }

    function autocompletar_matriculas($matricula)
    {
        $this->db->distinct();
        $this->db->select('MATRICULA');
        $this->db->like('MATRICULA',$matricula,'both');
        $this->db->order_by('MATRICULA','ASC');
        $this->db->limit(10);
        $comandos = $this->db->get('VIATURAS');
        
        return $comandos->result();
    }



    


    function aSairdeArea($idlocal)
    {
		 $comandos = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.NOME, FOTO FROM BOLEIAS JOIN UTILIZADORES_BOLEIA
	ON UTILIZADORES_BOLEIA.IDBOLEIA = BOLEIAS.IDBOLEIA JOIN UTILIZADORES ON (UTILIZADORES.IDUTILIZADOR = UTILIZADORES_BOLEIA.IDUTILIZADOR AND UTILIZADORES_BOLEIA.CONDUTOR = 1) JOIN (LOCAIS AS ORIG) ON (ORIG.IDLOCAL = BOLEIAS.ORIGEM AND ORIG.IDLOCAL = ?) JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO WHERE BOLEIAS.ACTIVO = 1',$idlocal);
        
        return $comandos;
    }

    function devolverPorUtilizador($utilizador)
    {
        $util = $_SESSION["no_utilizador"];

        $queryuser = "SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.NOME, FOTO FROM BOLEIAS JOIN UTILIZADORES_BOLEIA ON (UTILIZADORES_BOLEIA.IDBOLEIA = BOLEIAS.IDBOLEIA AND BOLEIAS.IDBOLEIA IN (SELECT IDBOLEIA FROM UTILIZADORES_BOLEIA WHERE IDUTILIZADOR = $util AND ACTIVO=1)) JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UTILIZADORES_BOLEIA.IDUTILIZADOR JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO WHERE UTILIZADORES_BOLEIA.CONDUTOR = 1 AND BOLEIAS.ACTIVO = 1";

        $queryuser .= ' ORDER BY BOLEIAS.DATA_DE_PARTIDA ASC';



        $b = $this->db->query($queryuser);

        return $b;
    }
    
    
    function pesquisar($dados)
    {
        $_partida = '1 OR 1=1';
        $_destino = '1 OR 1=1';
        $dataactualpesquisar = "'2000-06-01 00:00'";
        $dataseguinte = "'2030-06-01 00:00'";
        
        if($dados['partida'] != '')
        {
            $_partida = "'".$dados['partida']."'";
        }
        
        if($dados['destino'] != '')
        {
            $_destino = "'".$dados['destino']."'";
        }
        
        if($dados['horario'] != '')
        {
            $dataactualpesquisar = "'".$dados['horario'].' 00:00:00'."'";
            
            $datapesquisar = strtotime($dados['horario']);
            $dataseguinte = strtotime("+1 day", $datapesquisar);
            $dataseguinte = "'".date('Y-m-d', $dataseguinte).' 00:00:00'."'";
        }
        
        $minhaquery = "SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, NOME, FOTO
FROM BOLEIAS
JOIN UTILIZADORES_BOLEIA AS UB ON (UB.IDBOLEIA = BOLEIAS.IDBOLEIA AND UB.CONDUTOR = 1)
JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR
JOIN (LOCAIS AS ORIG) ON (ORIG.IDLOCAL = BOLEIAS.ORIGEM AND (ORIG.NOME_CIDADE = $_partida))
JOIN (LOCAIS AS DESTIN) ON (DESTIN.IDLOCAL = BOLEIAS.DESTINO AND (DESTIN.NOME_CIDADE = $_destino)) WHERE DATA_DE_PARTIDA >= $dataactualpesquisar and DATA_DE_PARTIDA < $dataseguinte";

        $comandos = $this->db->query($minhaquery);
        
        
        
        if(isset($comandos))    
        {
            return $comandos->result();
        }
        else
            return '';  
      
    
    }
    
    
    
    
    function getbyIDboleia($idbleia)
    {
        $obterporid = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.IDUTILIZADOR, UTILIZADORES.NOME AS NOME_UTIL, E_MAIL, FOTO, IDAREA, TELEFONE, CONDUTOR FROM UTILIZADORES_BOLEIA AS UB JOIN BOLEIAS ON UB.IDBOLEIA = BOLEIAS.IDBOLEIA JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO WHERE UB.IDBOLEIA = ? AND UB.CONDUTOR = 1 ORDER BY DATA_DE_PARTIDA asc',$idbleia);
        
        return $obterporid->result();
        
        
    }
    
    function getbyIDboleia_soUmaLinha($idbleia)
    {
        $obterporid = $this->db->query('SELECT BOLEIAS.IDBOLEIA, BOLEIAS.IDVIATURA, ORIG.NOME_CIDADE AS ORIGEM, DESTIN.NOME_CIDADE AS DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, OBJECTIVO_PESSOAL, ESTADO, UTILIZADORES.IDUTILIZADOR, UTILIZADORES.NOME AS NOME_UTIL, E_MAIL, FOTO, IDAREA, TELEFONE, CONDUTOR, ORIG.LAT AS Lat_partida, ORIG.LNG AS Lng_partida, DESTIN.LAT AS Lat_destino, DESTIN.LNG AS Lng_destino FROM UTILIZADORES_BOLEIA AS UB JOIN BOLEIAS ON UB.IDBOLEIA = BOLEIAS.IDBOLEIA JOIN UTILIZADORES ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM JOIN (LOCAIS AS DESTIN) ON DESTIN.IDLOCAL = BOLEIAS.DESTINO WHERE UB.IDBOLEIA = ? AND UB.CONDUTOR = 1 LIMIT 1',$idbleia);
        
        return $obterporid->result();
        
        
    }
    
    function getbyIDpassageiros($idbleia)
    {
        $comandos = $this->db->query('SELECT NOME, FOTO, OBJECTIVO_PESSOAL
FROM UTILIZADORES_BOLEIA AS UB
JOIN UTILIZADORES
	ON UTILIZADORES.IDUTILIZADOR = UB.IDUTILIZADOR
WHERE UB.ACTIVO = 1 AND UTILIZADORES.ACTIVO = 1 AND UB.CONDUTOR = 0 AND IDBOLEIA = ?',$idbleia);
        
        return $comandos->result();
        
        
    }
    
    
    function getCombustivel() //para criação de menu pendente com o combustível
    {
        $this->db->select('IDCOMBUSTIVEL, COMBUSTIVEL');
        $this->db->from('COMBUSTIVEL');
         
        $resultado = $this->db->get();
             
        return $resultado->result();
    }

    function getCoordenadas($idboleia,$part)
    {
        // Se $part for 0, pesquisa a partida
        // Se $part for 1, pesquisa a chegada

        if($part == 0)
        {
        $fazer = $this->db->query('SELECT LAT, LNG FROM BOLEIAS JOIN (LOCAIS AS ORIG) ON ORIG.IDLOCAL = BOLEIAS.ORIGEM WHERE IDBOLEIA = ?',$idboleia);

        return $fazer;

        }
        else
        {
        $fazer = $this->db->query('SELECT LAT, LNG FROM BOLEIAS JOIN (LOCAIS AS DEST) ON DEST.IDLOCAL = BOLEIAS.DESTINO WHERE IDBOLEIA = ?',$idboleia);

        return $fazer;

        }

    }

    function bagagem_getbyIDboleia($id)
    {
        $fazer = $this->db->query('SELECT ENCOMENDAS.IDENCOMENDA, 
            DATA_DE_ENTRADA, 
            DESCRICAO_ENCOMENDA, 
            REMT.NOME AS REMETENTE, 
            DEST.NOME AS DESTINATARIO
            FROM ENCOMENDAS 
            JOIN UTILIZADOR_ENCOMENDAS AS UE ON UE.IDENCOMENDA = ENCOMENDAS.IDENCOMENDA 
            JOIN (UTILIZADORES AS REMT) ON REMT.IDUTILIZADOR = UE.IDREMETENTE 
            JOIN (UTILIZADORES AS DEST) ON DEST.IDUTILIZADOR = UE.IDDESTINATARIO WHERE IDBOLEIA = ?',$id);

        return $fazer;
    }

    function getbyIDbagagem($id)
    {
        $fazer = $this->db->query('SELECT ENCOMENDAS.IDENCOMENDA, 
            DATA_DE_ENTRADA, 
            DESCRICAO_ENCOMENDA, 
            REMT.IDUTILIZADOR AS IDREMETENT,
            DEST.IDUTILIZADOR AS IDDESTINATAR,
            REMT.NOME AS REMETENTE, 
            DEST.NOME AS DESTINATARIO
            FROM ENCOMENDAS 
            JOIN UTILIZADOR_ENCOMENDAS AS UE ON (UE.IDENCOMENDA = ENCOMENDAS.IDENCOMENDA AND UE.IDENCOMENDA = ?)
            JOIN (UTILIZADORES AS REMT) ON REMT.IDUTILIZADOR = UE.IDREMETENTE 
            JOIN (UTILIZADORES AS DEST) ON DEST.IDUTILIZADOR = UE.IDDESTINATARIO',$id);

        return $fazer->row();
    }
    
}
?>