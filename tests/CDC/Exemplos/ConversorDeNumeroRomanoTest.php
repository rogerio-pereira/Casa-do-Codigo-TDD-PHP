<?php

namespace CDC\Exemplos;

use CDC\Exemplos\ConversorDeNumeroRomano;
use PHPUnit_Framework_TestCase as PHPUnit;

class ConversorDeNumeroRomanoTest extends PHPUnit
{
    public function testDeveReconhecerOSimboloI()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('I');
        $this->assertEquals(1, $numero);
    }

    public function testDeveReconhecerOSimboloV()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('V');
        $this->assertEquals(5, $numero);
    }
}