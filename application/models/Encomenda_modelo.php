<?php
class Encomenda_modelo extends CI_Model
{
    function criarEncomenda($dados)
    {

        $query = 'INSERT INTO ENCOMENDAS (IDBOLEIA, DATA_DE_ENTRADA, DESCRICAO_ENCOMENDA) VALUES ('.$dados['IDBOLEIA'].', NOW(), \''.$dados['DESCRICAO_ENCOMENDA'].'\')';

        $this->db->query($query);

        $linhas = $this->db->affected_rows();
        if($linhas >= 1)
        {
            return $this->db->insert_id();
        }
        else
        {
            return -1;
        }
    }

    function criarassocUtilizadorEncomenda($dados)
    {
         $this->db->insert('UTILIZADOR_ENCOMENDAS',$dados);

        $linhas = $this->db->affected_rows();
        if($linhas >= 1)
        {
            return $this->db->insert_id();
        }
        else
        {
            return -1;
        }
     
    }

    function criarassocUtilizadorBoleia($dados)
    {
         $this->db->insert('UTILIZADOR_ENCOMENDAS',$dados);

        $linhas = $this->db->affected_rows();
        if($linhas >= 1)
        {
            return $this->db->insert_id();
        }
        else
        {
            return -1;
        }
     
    }
    
}
?>