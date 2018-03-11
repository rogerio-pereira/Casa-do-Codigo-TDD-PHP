<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Exemplos\RelogioDoSistema;
use CDC\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface;
use CDC\Loja\FluxoDeCaixa\GeradorDeNotaFiscal;
use CDC\Loja\FluxoDeCaixa\NFDao;
use CDC\Loja\FluxoDeCaixa\Pedido;
use CDC\Loja\FluxoDeCaixa\SAP;
use CDC\Loja\Test\TestCase;
use CDC\Loja\Tributos\TabelaInterface;
use Mockery;

class GeradorDeNotaFiscalTest extends TestCase
{
    public function testDeveGerarNFComValorDeImpostosDescontados()
    {
        $tabela = Mockery::mock(TabelaInterface::class);
        $tabela->shouldReceive('paraValor')->with(1000.0)->andReturn(0.2);

        $gerador = new GeradorDeNotaFiscal(array(), new RelogioDoSistema(), $tabela);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000 * 0.8, $nf->getValor(), null, 0,00001);
    }

    public function testDevePersistirNFGerada()
    {
        $tabela = Mockery::mock(TabelaInterface::class);
        $tabela->shouldReceive('paraValor')->with(1000.0)->andReturn(0.2);

        $acao1 = Mockery::mock(AcaoAposGerarNotaInterface::class);
        $acao1->shouldReceive('executa')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal(array($acao1), new RelogioDoSistema(), $tabela);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($acao1->executa($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf(NotaFiscal::class, $nf);
        $this->assertEquals(1000 * 0.8, $nf->getValor(), null, 0.00001);
    }

    public function testDeveEnviarNFGeradaParaSAP()
    {
        $tabela = Mockery::mock(TabelaInterface::class);
        $tabela->shouldReceive('paraValor')->with(1000.0)->andReturn(0.2);

        $acao1 = Mockery::mock(AcaoAposGerarNotaInterface::class);
        $acao1->shouldReceive('executa')->andReturn(true);

        $acao2 = Mockery::mock(AcaoAposGerarNotaInterface::class);
        $acao2->shouldReceive('executa')->andReturn(true);

        $gerador = new GeradorDeNotaFiscal(array($acao1, $acao2), new RelogioDoSistema(), $tabela);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($acao1->executa($nf));
        $this->assertTrue($acao2->executa($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf(NotaFiscal::class, $nf);
        $this->assertEquals(1000 * 0.8, $nf->getValor(), null, 0.00001);
    }

    public function testDeveConsultarATabelaParaCalcularOValor()
    {
        $tabela = Mockery::mock(TabelaInterface::class);

        //Definindo o futuro comportamento "paraValor", que deve retorna 0.2 caso o valor seja 1000.0
        $tabela->shouldReceive('paraValor')->with(1000.0)->andReturn(0.2);

        $gerador = new GeradorDeNotaFiscal(array(), new RelogioDoSistema(), $tabela);
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000 * 0.8, $nf->getValor(), null, 0.00001);
    }
}