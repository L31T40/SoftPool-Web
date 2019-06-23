<?php
class Criar_modelo extends CI_Model
{    
    
    function getdatamesmodia($data,$hora)
    {
        $dataaformatar = strtotime($data);
        $dataformatada = date('Y-m-d', $dataaformatar);
        $string = $dataformatada.' '.$hora;
        return $string;
    }
    
    function getdataChegadadiaseguinte($data,$hora)
    {

        $dataaprocessar = strtotime($data);
        $dataseguinte = strtotime("+1 day", $dataaprocessar);
        $dataseguinte = date('Y-m-d', $dataseguinte).' '.$hora;
        return $dataseguinte;
    }
    
       
    function ConverterLocal($local)
    {
        $newlocal = $this->db->query('SELECT IDLOCAL FROM LOCAIS WHERE NOME_CIDADE = ? LIMIT 1',$local);

        if($newlocal->num_rows() == 0)
        {
           return -1;
        }
        else
        {
            $loc = $newlocal->row();
            return $loc->IDLOCAL;
        }
    }
    
    function addLocal()
    {
        /* Ver controlador inserirLocal */
        
        $newlocal = array(
            'NOME_CIDADE' => $_POST['loc'],
            'LAT' => $_POST['latitud'],
            'LNG' => $_POST['longitud']
        );
        
        
        $query = $this->db->insert('LOCAIS',$newlocal);
        
        if($this->db->affected_rows()>=1)
        {
            return $this->db->insert_id();
        }
        else
        {
            return -1;
        }
    }
    
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
    
    function addVeiculo($viatura)
    {
        /* Ver controlador inserirLocal */
        
        $query = $this->db->insert('VIATURAS',$viatura);
        
        /*$query = 'INSERT INTO LOCAIS (ACTIVO, IDUTILIZADOR, MARCA, MODELO, MATRICULA, SEGURO_CONTRA_TODOS_OS_RISCOS) VALUES (';
        
        $query .= $local['ACTIVO'];
        $query .= ", '".$local['IDUTILIZADOR']."'";
        $query .= ", '".$local['MARCA']."'";
        $query .= ", '".$local['MODELO']."'";
        $query .= ", '".$local['MATRICULA']."'";
        $query .= ", '".$local['SEGURO_CONTRA_TODOS_OS_RISCOS']."'";
        $query .= ')';
        
        $this->db->query($query);*/
        
        if($this->db->affected_rows()>=1)
        {
            return $this->db->insert_id();
        }
        else
        {
            return -1;
        }
    }
    
    
    function criar($dados)
    {
        if(strtotime($dados['horasdestino']) <= strtotime($dados['horaspartida']))
        {
            $datapartida = Criar_modelo::getdatamesmodia($dados['datapartida'],$dados['horaspartida']);
            
            $datachegada = Criar_modelo::getdataChegadadiaseguinte($dados['datapartida'],$dados['horasdestino']);
        }
        else
        {
            $datapartida = Criar_modelo::getdatamesmodia($dados['datapartida'],$dados['horaspartida']);
            
            $datachegada = Criar_modelo::getdatamesmodia($dados['datapartida'],$dados['horasdestino']);
        }
        
         /*echo 'Data de partida: '.$datapartida.';   Data de chegada: '.$datachegada;
        
        die();*/

        $query = 'INSERT INTO BOLEIAS (IDVIATURA, ORIGEM, DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA, LUGARES_DISPONIVEIS, ESTADO, ACTIVO) VALUES (';
        
        $query .= $dados['viatura'];
        $query .= ", ".$dados['idorigem'];
        $query .= ", ".$dados['iddestino'];
        $query .= ", NOW()";
        $query .= ", '".$datapartida."'";
        $query .= ", '".$datachegada."'";
        $query .= ", ".$dados['lotacao'];
        $query .= ", 1, 1)";
        
        $this->db->query($query);
        
        $id = $this->db->insert_id();

        if($id < 1)
        {
            return 0;
        }
        else
        {
            $user = $_SESSION['no_utilizador'];

            $obj = -1;

            $obj = $dados['objectivo'];

            $this->db->query("INSERT INTO UTILIZADORES_BOLEIA (IDBOLEIA, IDUTILIZADOR, CONDUTOR, ACTIVO, OBJECTIVO_PESSOAL) VALUES ($id,$user,1,1,$obj)");

            if($this->db->affected_rows()<1)
                return 0;
            else
                return 1;
        }

        
        
    } 
    
    
    
    function criarBoleiaMobile($dadosboleia)
    {
       

        $query = "INSERT INTO BOLEIAS (IDVIATURA, ORIGEM, DESTINO, DATA_CRIACAO, DATA_DE_PARTIDA, DATA_DE_CHEGADA,
        LUGARES_DISPONIVEIS, ESTADO, ACTIVO) VALUES (";
        
        $query .= $dadosboleia['IDVIATURA'];
        $query .= ", ".$dadosboleia['ORIGEM'];
        $query .= ", ".$dadosboleia['DESTINO'];
        $query .= ", NOW()";
        $query .= ", '".$dadosboleia['DATA_DE_PARTIDA']."'";
        $query .= ", '".$dadosboleia['DATA_DE_CHEGADA']."'";
        $query .= ", ".$dadosboleia['LUGARES_DISPONIVEIS'];
        $query .= ", 1";
        $query .= ", 1";
        $query .= ")";
        
        
        $this->db->query($query);
               
        $id = $this->db->insert_id();

        $user = $dadosboleia['IDUTILIZADOR'];

        $obj = $dadosboleia['OBJECTIVO_PESSOAL'];

        $this->db->query("INSERT INTO UTILIZADORES_BOLEIA (IDBOLEIA, IDUTILIZADOR, CONDUTOR, OBJECTIVO_PESSOAL) VALUES ($id,$user,1,$obj)");
        
        
    }
    

    
}
?>