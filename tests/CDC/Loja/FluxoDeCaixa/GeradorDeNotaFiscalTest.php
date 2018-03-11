<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface;
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
        $gerador = new GeradorDeNotaFiscal(array());
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0,00001);
    }

    public function testDevePersistirNFGerada()
    {
        $acao1 = Mockery::mock('CDC\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface');
        $acao1->shouldReceive('executa')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal(array($acao1));
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($acao1->executa($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf(NotaFiscal::class, $nf);
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.00001);
    }

    public function testDeveEnviarNFGeradaParaSAP()
    {
        $acao1 = Mockery::mock('CDC\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface');
        $acao1->shouldReceive('executa')->andReturn(true);

        $acao2 = Mockery::mock('CDC\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface');
        $acao2->shouldReceive('executa')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal(array($acao1, $acao2));
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($acao1->executa($nf));
        $this->assertTrue($acao2->executa($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf(NotaFiscal::class, $nf);
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.00001);
    }
}