<?php

namespace App\Http\Traits;


trait TraitHelper
{
    public function validaDataBrTrait($data):bool
    {
        $data = explode("/","$data"); // fatia a string $dat em pedados, usando / como referência
	    $d = $data[0];
        $m = $data[1];
        $y = $data[2];
    
        // verifica se a data é válida!
        // 1 = true (válida)
        // 0 = false (inválida)
        $res = checkdate($m,$d,$y);
        if ($res == 1){
            return true;
        } 

        return false;
    }

    public function dataToUsTrait($dataBr):string 
    {
        return implode("-", array_reverse(explode("/",$dataBr)));
    }

    public function dataToBrTrait($dataUs):string 
    {
        return implode("/", array_reverse(explode("-",$dataUs)));
    }
}