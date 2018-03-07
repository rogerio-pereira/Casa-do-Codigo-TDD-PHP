<?php

namespace CDC\Exemplos;

use PHPUnit_Framework_TestCase as PHPUnit;

class ConversorDeNumeroRomanoTest extends PHPUnit
{
    public function testDeveReconhecerOSimboloI()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('I');
        $this->assertEquals(1, $numero);
    }
}