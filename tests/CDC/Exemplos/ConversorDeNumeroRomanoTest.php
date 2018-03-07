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

    public function testDeveReconhecerOSimboloX()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('X');
        $this->assertEquals(10, $numero);
    }

    public function testDeveReconhecerOSimboloL()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('L');
        $this->assertEquals(50, $numero);
    }

    public function testDeveReconhecerOSimboloC()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('C');
        $this->assertEquals(100, $numero);
    }

    public function testDeveReconhecerOSimboloD()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('D');
        $this->assertEquals(500, $numero);
    }

    public function testDeveReconhecerOSimboloM()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('M');
        $this->assertEquals(1000, $numero);
    }

    public function testDeveReconhecerOSimboloII()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('II');
        $this->assertEquals(2, $numero);
    }

    public function testDeveReconhecerOSimboloXX()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('XX');
        $this->assertEquals(20, $numero);
    }
}