<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\GeradorDeNotaFiscal;
use CDC\Loja\FluxoDeCaixa\Pedido;
use CDC\Loja\Test\TestCase;
use Mockery;

class GeradorDeNotaFiscalTest extends TestCase
{
    public function testDeveGerarNFComValorDeImpostosDescontados()
    {
        $dao = Mockery::mock('CDC\Loja\FluxoDeCaixa\NFDao');
        $dao->shouldReceive('persiste')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal($dao);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0,00001);
    }

    public function testDevePersistirNFGerada()
    {
        $dao = Mockery::mock('CDC\Loja\FluxoDeCaixa\NFDao');
        $dao->shouldReceive('persiste')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal($dao);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($dao->persiste($nf));
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.00001);
    }
}