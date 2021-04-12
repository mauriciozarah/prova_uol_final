<?php 


namespace App\Helpers;

class Helper
{
    public static function dataHoraToBr($dataUs){
        $vetor = explode(" ", $dataUs);
        $hora = $vetor[1];
        $data = implode("/", array_reverse(explode("-", $vetor[0])));

        return $data . " " . $hora;
    }

    public static function dataToBr($dataUs){
        $vetor = explode(" ", $dataUs);
        return implode("/", array_reverse(explode("-", $vetor[0])));
    }
}