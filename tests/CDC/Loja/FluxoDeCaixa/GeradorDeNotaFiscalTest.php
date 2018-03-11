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
    private $tabela;
    private $relogioDoSistema;
    private $acao1;
    private $acao2;

    public function setUp()
    {
        $this->tabela = Mockery::mock(TabelaInterface::class);
        $this->tabela->shouldReceive('paraValor')->with(1000.0)->andReturn(0.2);

        $this->relogioDoSistema = new RelogioDoSistema();

        $this->acao1 = Mockery::mock(AcaoAposGerarNotaInterface::class);
        $this->acao1->shouldReceive('executa')->andReturn(true);

        $this->acao2 = Mockery::mock(AcaoAposGerarNotaInterface::class);
        $this->acao2->shouldReceive('executa')->andReturn(true);
    }

    public function testDeveGerarNFComValorDeImpostosDescontados()
    {
        $gerador = new GeradorDeNotaFiscal(
                                            array(), 
                                            $this->relogioDoSistema, 
                                            $this->tabela
                                        );
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000 * 0.8, $nf->getValor(), null, 0,00001);
    }

    public function testDevePersistirNFGerada()
    {
        $gerador = new GeradorDeNotaFiscal(
                                            array($this->acao1), 
                                            $this->relogioDoSistema, 
                                            $this->tabela
                                        );
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($this->acao1->executa($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf(NotaFiscal::class, $nf);
        $this->assertEquals(1000 * 0.8, $nf->getValor(), null, 0.00001);
    }

    public function testDeveEnviarNFGeradaParaSAP()
    {
        $gerador = new GeradorDeNotaFiscal(
                                            array($this->acao1, $this->acao2), 
                                            $this->relogioDoSistema, 
                                            $this->tabela
                                        );
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertTrue($this->acao1->executa($nf));
        $this->assertTrue($this->acao2->executa($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf(NotaFiscal::class, $nf);
        $this->assertEquals(1000 * 0.8, $nf->getValor(), null, 0.00001);
    }

    public function testDeveConsultarATabelaParaCalcularOValor()
    {
        $gerador = new GeradorDeNotaFiscal(
                                            array(), 
                                            $this->relogioDoSistema, 
                                            $this->tabela
                                        );
        $pedido = new Pedido("Rogério", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000 * 0.8, $nf->getValor(), null, 0.00001);
    }
}