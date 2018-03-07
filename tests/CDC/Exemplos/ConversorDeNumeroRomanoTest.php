<?php

namespace CDC\Exemplos;

use CDC\Exemplos\ConversorDeNumeroRomano;
use CDC\Loja\Test\TestCase;

class ConversorDeNumeroRomanoTest extends TestCase
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

    public function testDeveReconhecerOSimboloXXII()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('XXII');
        $this->assertEquals(22, $numero);
    }

    public function testDeveReconhecerOSimboloXXX()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('XXX');
        $this->assertEquals(30, $numero);
    }

    public function testDeveReconhecerOSimboloXXXIII()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('XXXIII');
        $this->assertEquals(33, $numero);
    }

    public function testDeveReconhecerOSimboloIX()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('IX');
        $this->assertEquals(9, $numero);
    }

    public function testDeveReconhecerOSimboloXXIV()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte('XXIV');
        $this->assertEquals(24, $numero);
    }
}