<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('formatardata'))
{
    function formatardata($data)
    {
        $_data = DateTime::createFromFormat('Ymd', $data);
        return $_data->format('Y-m-d');
    }
}

if(!function_exists('MesExtensoparaPortugues'))
{
    function MesExtensoparaPortugues($mes)
    {
        switch($mes){
            case 1: return 'Janeiro';
            case 2: return 'Fevereiro';
            case 3: return 'Março';
            case 4: return 'Abril';
            case 5: return 'Maio';
            case 6: return 'Junho';
            case 7: return 'Julho';
            case 8: return 'Agosto';
            case 9: return 'Setembro';
            case 10: return 'Outubro';
            case 11: return 'Novembro';
            case 12: return 'Dezembro';
            default: return 'Mês inválido';
        }
    }
}

if (!function_exists('MesDiaPortugues'))    
{   
    function MesDiaPortugues($stringdata)
    {
        $databoleia = strtotime($stringdata);
        $mes = MesExtensoParaPortugues(date("m",$databoleia));
        $dia = date("d",$databoleia);
        $dataportugues = $mes." ".$dia;
        return $dataportugues;
    }
}

if (!function_exists('is_empty'))   
{
    function is_empty($var)
    {
        return empty($var);
    }
}