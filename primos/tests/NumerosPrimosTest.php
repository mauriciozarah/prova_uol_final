<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\NumerosPrimos;

class NumerosPrimosTest extends TestCase
{
    public function testNumerosPrimos()
    {
        $numerosEsperados = [2, 3, 5, 7, 11, 13, 17, 19];

        $limite = 20;

        $numerosPrimos = new NumerosPrimos();

        $numerosRecebidos = $numerosPrimos->Calcular($limite);

        $this->assertEquals($numerosEsperados, $numerosRecebidos);
    }
}
