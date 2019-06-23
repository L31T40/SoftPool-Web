<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Obterdetalhesboleia extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->model('Activas_modelo');
        
    }
    
    public function detalhesboleia($id)
    {
        
        if(!IS_AJAX)
        {
            return;
        }
        
        $detalhdados["boleia"] = $this->Activas_modelo->getbyIDboleia_soUmaLinha($id);
        
        $detalhdados["utilizadores"] = $this->Activas_modelo->getbyIDpassageiros($id);

        $detalhdados["bagagem"] = '';
        
        $bag = $this->Activas_modelo->bagagem_getbyIDboleia($id);

        if($bag->num_rows() > 0)
            $detalhdados["bagagem"] = $bag->result();

        /* Obter as horas em formato hh:mm */
        
        $datatimepartida = strtotime($detalhdados["boleia"][0]->DATA_DE_PARTIDA);
        $horapartida = date('H:i',$datatimepartida);
        $datatimedestino = strtotime($detalhdados["boleia"][0]->DATA_DE_CHEGADA);
        $horadestino = date('H:i',$datatimedestino);
        
        $str1 = '';
        
        $str1 .= '<div id="'.$detalhdados["boleia"][0]->IDBOLEIA.'" class="azul">';
        $str1 .= '<div id="fecharmodal" class="mb_icone">';
        $str1 .= '<img src="'.base_url().'assets/imagens/cruz.svg">';
        $str1 .= '</div>';
        $str1 .= '<div class="mb_banneroculto azulclaro">';
        $str1 .= '</div>';
        $str1 .= '<div class="mb_cantodobanner branco">';
        $str1 .= '<div class="mb_imagemcondutor"><img src="'.base_url().'assets/fotos/'.$detalhdados["boleia"][0]->FOTO.'"></div>';
        $str1 .= '<div class="mb_condutor">'.$detalhdados["boleia"][0]->NOME_UTIL.'</div>';
        $str1 .= '</div>';
        $str1 .= '<input class="mb_escondido" type="text" value="'.$detalhdados["boleia"][0]->Lat_partida.','.$detalhdados["boleia"][0]->Lng_partida.'" id="mb_get_coordpartida_'.$detalhdados["boleia"][0]->IDBOLEIA.'">';
        $str1 .= '<input class="mb_escondido" type="text" value="'.$detalhdados["boleia"][0]->Lat_destino.','.$detalhdados["boleia"][0]->Lng_destino.'" id="mb_get_coorddestino_'.$detalhdados["boleia"][0]->IDBOLEIA.'">';
        $str1 .= '<div class="mb_bannerprincipal branco">';
        $str1 .= '<div class="mb_flexboxcontactos">';
        $str1 .= '<div class="mb_databoleia azulclaro">';
        $str1 .= '<div class="mb_iconeflex">';
        $str1 .= '<img src="'.base_url().'assets/imagens/inserirboleia-cal.svg">';
        $str1 .= '</div>';
        $str1 .= '<span class="mb_datadataboleia">'.MesDiaPortugues($detalhdados["boleia"][0]->DATA_DE_PARTIDA).'</span>';
        $str1 .= '</div>';
        $str1 .= '';
        $str1 .= '';
        
        $str2 = '';
        
        $str2 .= '<div class="mb_iconeflexbox">';
        $str2 .= '<div class="mb_caixamensagens" data-id="'.$detalhdados["boleia"][0]->IDBOLEIA.'" data-toggle="tooltip" title="Ver mensagens da boleia"></div>';
        $str2 .= '<div class="mb_contactartodos" data-id="'.$detalhdados["boleia"][0]->IDBOLEIA.'" data-toggle="tooltip" title="Contactar passageiros e/ou condutor"></div>';
        /*$str2 .= '<div class="mb_contactarcondutor" data-id="'.$detalhdados["boleia"][0]->IDBOLEIA.'" data-toggle="tooltip" title="Contactar condutor"></div>';*/
        $str2 .= '<div class="mb_telefone" data-id="'.$detalhdados["boleia"][0]->IDBOLEIA.'" data-toggle="tooltip" title="Telefone do condutor: '.$detalhdados["boleia"][0]->TELEFONE.'"></div>';
        $str2 .= '</div>';
        $str2 .= '</div>';
        $str2 .= '<div class="mb_flexboxgrande">';
        $str2 .= '<div class="mb_flexboxpassageirosebagagens">';
        $str2 .= '<div class="mb_listapassageiros">';
        
        $str3 = '';
        
        foreach($detalhdados["utilizadores"] as $user)
        {
            $str3 .= '<div class="mb_passageiro">';
            $str3 .= '<img class="mb_passageiro_img" src="'.base_url().'assets/fotos/'.$user->FOTO.'" title="'.$user->NOME.'">';
            $str3 .= '<img class="mb_trabalhooulazer" src="'.base_url();

            if($user->OBJECTIVO_PESSOAL == 0)
                $str3 .= 'assets/imagens/viajoemtrabalho.svg">';
            else
                $str3 .= 'assets/imagens/viajoemlazer.svg">';

            $str3 .= '</div>';
        }
        
        
        $str3 .= '</div>';
        
        
        $str4 = '';
        
        $str4 .= '<div class="mb_listabagagens">';

        /* Vou aquiiiiiiiii */

        if(!empty($detalhdados["bagagem"]))
        {
            foreach($detalhdados["bagagem"] as $bagag)  
            {      
        
            $str4 .= '<div class="mb_obterBagbagagem mb_passageiro" id="idenc-'.$bagag->IDENCOMENDA.'">';
            $str4 .= '<img class="mb_passageiro_img" src="'.base_url().'assets/imagens/mb_bagagem.svg">';
            $str4 .= '</div>';
            }
        }
        
        /* Utilizar para as bagagens
        
        $str4 .= '<div class="mb_bagagem">';
        $str4 .= '</div>';
        $str4 .= '<div class="mb_bagagem">';
        $str4 .= '</div>';
        $str4 .= '<div class="mb_bagagem">';
        $str4 .= '</div>';
        $str4 .= '<div class="mb_bagagem">';
        $str4 .= '</div>';
        
        */
      
        $str5 = '';
        $str5 .= '</div>';
        $str5 .= '</div>';
        $str5 .= '<div class="mb_horarioboleiaebotoes">';
        $str5 .= '<div class="mb_horarioboleia">';
        
        $str5 .= '<div class="mb_larguratotal">';
        $str5 .= '<div class="mb_elemento">';
        $str5 .= '<div class="mb_phpequenosembase">';
        $str5 .= '<img src="'.base_url().'assets/imagens/mb_phsembase.svg">';
        $str5 .= '</div>'.$detalhdados["boleia"][0]->ORIGEM.'</div>';
        $str5 .= '<div class="mb_setas"><img src="'.base_url().'assets/imagens/setasdireita.svg"></div><div class="mb_elemento">';
        $str5 .= '<div class="mb_phpequeno"><img src="'.base_url().'assets/imagens/placeholder.svg">';
        $str5 .= '</div>'.$detalhdados["boleia"][0]->DESTINO.'</div></div>';
        $str5 .= '<div class="mb_larguratotal">';
        $str5 .= '<div class="mb_elemento"><div class="mb_relogio"><img src="'.base_url().'assets/imagens/relogio.svg">';
        $str5 .= '</div>'.$horapartida.'</div><div class="mb_setas"><img src="'.base_url().'assets/imagens/setasdireita.svg">';
        $str5 .= '</div><div class="mb_elemento">'.$horadestino.'</div>';
        $str5 .= '</div>';
        $str5 .= '</div>';
        $str5 .= '<div class="mb_botaoverde" id="acordeao">';
        $str5 .= '<div class="mb_botaoimagem"><img src="'.base_url().'assets/imagens/mb_addboleia.svg"></div><div class="mb_botaoadicionar mb_largurabotao">Adicionar</div>';
        $str5 .= '</div>';
        $str5 .= '<div class="esconder" id="subbotoes">';
        $str5 .= '<div class="mb_botaoazul mb_addbprof" id="idbol-'.$detalhdados["boleia"][0]->IDBOLEIA.'">';
        $str5 .= '<div class="mb_botaoimagem"><img src="'.base_url().'assets/imagens/mb_addboleia.svg"></div><div class="mb_botaoadicionar mb_largurabotao">Profissional</div>';
        $str5 .= '</div>';
        $str5 .= '<div class="mb_botaoazul mb_addbpess" id="idbol-'.$detalhdados["boleia"][0]->IDBOLEIA.'">';
        $str5 .= '<div class="mb_botaoimagem"><img src="'.base_url().'assets/imagens/mb_addboleia.svg"></div><div class="mb_botaoadicionar mb_largurabotao">Pessoal</div>';
        $str5 .= '</div>';
        $str5 .= '</div>';
        $str5 .= '<div class="mb_botaoverde mb_cancb" id="idbol-'.$detalhdados["boleia"][0]->IDBOLEIA.'">';
        $str5 .= '<div class="mb_botaoimagem"><img src="'.base_url().'assets/imagens/mb_cancboleia.svg"></div><div class="mb_botaocancelar mb_largurabotao">Cancelar</div>';
        $str5 .= '</div>';
        $str5 .= '<div class="mb_botaoverde mb_addenc" id="idbol-'.$detalhdados["boleia"][0]->IDBOLEIA.'">';
        $str5 .= '<div class="mb_botaoimagem"><img src="'.base_url().'assets/imagens/mb_addencomenda.svg"></div><div class="mb_botaoadencomenda mb_largurabotao"><span>Adicionar Encomenda</span></div>';
        $str5 .= '</div>';
        $str5 .= '</div>';
        $str5 .= '<div class="map" id="mapa'.$detalhdados["boleia"][0]->IDBOLEIA.'"></div>';
        $str5 .= '</div>';
        $str5 .= '</div>';
        
        $str = $str1.$str2.$str3.$str4.$str5;
        
        echo $str;


    }

    public function coordenadaspartida($id)
    {
        $fazer = $this->Activas_modelo->getCoordenadas($id,0);

        if($fazer->num_rows() == 1)
        {
            $string = $fazer->row()->LAT.','.$fazer->row()->LNG;
            echo $string;
        }
        else
        {
            echo -1;
        }
    }

    public function coordenadasdestino($id)
    {
        $fazer = $this->Activas_modelo->getCoordenadas($id,1);

        if($fazer->num_rows() == 1)
        {
            $string = $fazer->row()->LAT.','.$fazer->row()->LNG;
            echo $string;
        }
        else
        {
            echo -1;
        }
    }


}

?>