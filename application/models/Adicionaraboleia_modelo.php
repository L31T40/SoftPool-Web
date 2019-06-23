<?php
class Adicionaraboleia_modelo extends CI_Model
{    
    function nopassageiros_contar_e_obter($idbol)
    {
        $resultado = $this->db->query("SELECT (SELECT COUNT(*) FROM UTILIZADORES_BOLEIA WHERE ACTIVO = 1 AND OBJECTIVO_PESSOAL = 1 AND IDBOLEIA = $idbol AND CONDUTOR = 0) AS NO_PASSAG_PESSOAIS, (SELECT COUNT(*) FROM UTILIZADORES_BOLEIA WHERE ACTIVO = 1 AND OBJECTIVO_PESSOAL = 0 AND IDBOLEIA = $idbol AND CONDUTOR = 0) AS NO_PASSAG_PROFISSIONAIS, (SELECT LUGARES_DISPONIVEIS FROM BOLEIAS WHERE IDBOLEIA = $idbol) AS LUGARES");

       /* Contagem exclui sempre o condutor!!! */

    $dadosadevolver = array(
        'nro_passageiros_pessoais' => $resultado->row()->NO_PASSAG_PESSOAIS,
        'nro_passageiros_prof' => $resultado->row()->NO_PASSAG_PROFISSIONAIS,
        'lugares' => $resultado->row()->LUGARES,
        'passageiros_pessoais' => array()
    );


    if($dadosadevolver['nro_passageiros_pessoais']>0)
    {
        $query = $this->db->query('SELECT IDUTILIZADORBOLEIA FROM UTILIZADORES_BOLEIA WHERE IDBOLEIA = ? AND ACTIVO = 1 AND OBJECTIVO_PESSOAL = 1 ORDER BY IDUTILIZADORBOLEIA DESC',$idbol);

        $dadosadevolver['passageiros_pessoais'] = $query->result_array();
    }
    


    return $dadosadevolver;
    }
    
    function verificarsevai($id)
    {
        $this->db->select('IDUTILIZADORBOLEIA');
        $this->db->where('IDUTILIZADOR',$_SESSION['no_utilizador']);
        $this->db->where('IDBOLEIA',$id);
        $this->db->where('ACTIVO',1);
        $resultado = $this->db->get('UTILIZADORES_BOLEIA');
        
        if($resultado->num_rows() == 1)
        {
           return $resultado->row('IDUTILIZADORBOLEIA');
        }
        else if($resultado->num_rows() > 1)
        {
            return -1;
        }
        else
        {
            return 0;
        }
    }
    
    function acrescentarpassageiro($id,$pess)
    {
        $util = $_SESSION["no_utilizador"];

        /*$dadosainserir = array(
            'IDBOLEIA' => $id,
            'IDUTILIZADOR' => $_SESSION["no_utilizador"],
            'CONDUTOR' => 0,
            'OBJECTIVO_PESSOAL' => $pess,
            'ACTIVO' => 1
        );*/
        
        $this->db->query("INSERT INTO UTILIZADORES_BOLEIA (IDBOLEIA, IDUTILIZADOR, CONDUTOR, OBJECTIVO_PESSOAL, ACTIVO) VALUES ($id,$util,0,$pess,1)");
        
        $linhas = $this->db->affected_rows();

        if($linhas >= 1)
        {
            $this->db->select('ESTADO, LUGARES_DISPONIVEIS');
            $this->db->where('IDBOLEIA',$id);
            $resultado = $this->db->get('BOLEIAS');

            $lugares = $resultado->row()->LUGARES_DISPONIVEIS;
            $estado = $resultado->row()->ESTADO;

            $utilizadoresnaboleia = $this->db->query("SELECT * FROM UTILIZADORES_BOLEIA WHERE IDBOLEIA = $id AND CONDUTOR = 0 AND ACTIVO = 1");


            $utilizadoresnaboleia = $utilizadoresnaboleia->num_rows();

            if($utilizadoresnaboleia == $lugares && $estado == 1)
            {
                $this->db->query("UPDATE BOLEIAS SET ESTADO = 2 WHERE IDBOLEIA = $id AND ESTADO = 1");
            }

       }

        return $linhas;
    }

    function acrescentarpassageiroMobile($id,$pessoal,$util)
    {
        $dadosainserir = array(
            'IDBOLEIA' => $id,
            'IDUTILIZADOR' => $util,
            'CONDUTOR' => 0,
            'OBJECTIVO_PESSOAL' => $pessoal,
            'ACTIVO' => 1,
        );
        
        $this->db->insert('UTILIZADORES_BOLEIA',$dadosainserir);
        
        $linhas = $this->db->affected_rows();

        return $linhas;
    }
    
    function acrescentarpassageiro_comtroca($idbol)
    {
        $query = $this->db->query('SELECT * FROM UTILIZADORES_BOLEIA WHERE IDBOLEIA = ? AND ACTIVO = 1 AND OBJECTIVO_PESSOAL = 1 ORDER BY IDUTILIZADORBOLEIA DESC',$idbol);

        $utilizadoratrocar = $query->result();

        if($idbol != $utilizadoratrocar[0]->IDBOLEIA)
        {
            return 0;
        }

    
        $inserir = array(
            'IDBOLEIA' => $idbol,
            'IDUTILIZADORBOLEIA' => $utilizadoratrocar[0]->IDUTILIZADORBOLEIA,
            'OBJECTIVO_PESSOAL' => 1,
            'IDUTILIZADOR' => $utilizadoratrocar[0]->IDUTILIZADOR
        );

        $this->db->insert('UTILIZADOR_BOLEIA_FILA',$inserir);

        $linha = $this->db->affected_rows();

        if($linha == 0)
        {
            return 0;
        }

        $this->db->set('ACTIVO',0);
        $this->db->where('IDUTILIZADORBOLEIA',$utilizadoratrocar[0]->IDUTILIZADORBOLEIA);
        $this->db->update('UTILIZADORES_BOLEIA');

        $linha2 = $this->db->affected_rows();

        if($linha2 == 0)
        {
            return 0;
        }

        $dadosainserir = array(
            'IDBOLEIA' => $idbol,
            'IDUTILIZADOR' => $_SESSION["no_utilizador"],
            'CONDUTOR' => 0,
            'OBJECTIVO_PESSOAL' => 0,
            'ACTIVO' => 1,
        );
        
        $this->db->insert('UTILIZADORES_BOLEIA',$dadosainserir);
        
        $linhas = $this->db->affected_rows();

        if($linhas >= 1)
        {
            $this->db->select('ESTADO, LUGARES_DISPONIVEIS');
            $this->db->where('IDBOLEIA',$idbol);
            $resultado = $this->db->get('BOLEIAS');

            $lugares = $resultado->row()->LUGARES_DISPONIVEIS;
            $estado = $resultado->row()->ESTADO;

            $utilizadoresnaboleia = $this->db->query("SELECT * FROM UTILIZADORES_BOLEIA WHERE IDBOLEIA = $idbol AND CONDUTOR = 0 AND ACTIVO = 1");


            $utilizadoresnaboleia = $utilizadoresnaboleia->num_rows();

            if($utilizadoresnaboleia == $lugares && $estado == 1)
            {
                $this->db->query("UPDATE BOLEIAS SET ESTADO = 2 WHERE IDBOLEIA = $idbol");
            }
        }

        return $linhas;

    
    }

    function removerpassageiro($id)
    {
        $this->db->where('IDUTILIZADORBOLEIA',$id);
        $this->db->where('CONDUTOR',1);
        $verificar = $this->db->get('UTILIZADORES_BOLEIA');

        if($verificar->num_rows() >= 1)
            return -1;     // caso seja o condutor, devolve -1

        $this->db->set('ACTIVO',0);
        $this->db->where('IDUTILIZADORBOLEIA',$id);
        $this->db->update('UTILIZADORES_BOLEIA');
        
        return $this->db->affected_rows();     // caso tenha tido efeito, devolve o número de linhas afectadas
    }

    
     function sairboleiamobile($dados)
    {
        $this->db->where('IDUTILIZADOR',$dados['IDUTILIZADOR']);
        $this->db->where('IDBOLEIA',$dados['IDBOLEIA']);
        $this->db->where('CONDUTOR',0);
        $this->db->set('ACTIVO',0);
        $this->db->update('UTILIZADORES_BOLEIA');
        
        //return $this->db->affected_rows();     // caso tenha tido efeito, devolve o número de linhas afectadas
    }   

    
    
}
?>