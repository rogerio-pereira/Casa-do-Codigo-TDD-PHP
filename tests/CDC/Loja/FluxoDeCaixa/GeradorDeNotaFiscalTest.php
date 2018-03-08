<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\GeradorDeNotaFiscal;
use CDC\Loja\FluxoDeCaixa\Pedido;
use CDC\Loja\Test\TestCase;

class GeradorDeNotaFiscalTest extends TestCase
{
    public function testDeveGerarNFComValorDeImpostosDescontados()
    {
        $gerador = new GeradorDeNotaFiscal();
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0,00001);
    }
}