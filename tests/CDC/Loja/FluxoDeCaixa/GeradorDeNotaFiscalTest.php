<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\GeradorDeNotaFiscal;
use CDC\Loja\FluxoDeCaixa\NFDao;
use CDC\Loja\FluxoDeCaixa\Pedido;
use CDC\Loja\FluxoDeCaixa\SAP;
use CDC\Loja\Test\TestCase;
use Mockery;

class GeradorDeNotaFiscalTest extends TestCase
{
    public function testDeveGerarNFComValorDeImpostosDescontados()
    {
        $dao = Mockery::mock(NFDao::class);
        $dao->shouldReceive('persiste')->andReturn(true);

        $sap = Mockery::mock(SAP::class);
        $sap->shouldReceive('envia')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal($dao, $sap);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0,00001);
    }

    public function testDevePersistirNFGerada()
    {
        $dao = Mockery::mock(NFDao::class);
        $dao->shouldReceive('persiste')->andReturn(true);

        $sap = Mockery::mock(SAP::class);
        $sap->shouldReceive('envia')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal($dao, $sap);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($dao->persiste($nf));
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.00001);
    }

    public function testDeveEnviarNFGeradaParaSAP()
    {
        $dao = Mockery::mock(NFDao::class);
        $dao->shouldReceive('persiste')->andReturn(true);

        $sap = Mockery::mock(SAP::class);
        $sap->shouldReceive('envia')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal($dao, $sap);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($sap->envia($nf));
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.00001);
    }
}