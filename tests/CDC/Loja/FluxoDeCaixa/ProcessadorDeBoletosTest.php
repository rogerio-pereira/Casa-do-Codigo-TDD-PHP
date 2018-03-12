<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\Fatura;
use CDC\Loja\FluxoDeCaixa\Boleto;
use CDC\Loja\FluxoDeCaixa\ProcessadorDeBoletos;
use CDC\Loja\Test\TestCase;

use ArrayObject;

class ProcessadorDeBoletosTest extends TestCase
{
    public function testDeveProcessarPagamentoViaBoletoUnico()
    {
        $processador = new ProcessadorDeBoletos();

        $fatura = new Fatura('Cliente', 150.0);
        $boleto = new Boleto(150.0);

        $boletos = new ArrayObject();
        $boletos->append($boleto);

        $processador->processa($boletos, $fatura);

        $this->assertEquals(1, count($fatura->getPagamentos()));
        $this->assertEquals(
                                150.0, 
                                $fatura->getPagamentos()[0]->getValor(), 
                                null, 
                                0.00001
                            );
    }

    public function testDeveProcessarPagamentoViaMuitosBoletos()
    {
        $processador = new ProcessadorDeBoletos();

        $fatura = new Fatura('Cliente', 300.0);

        $boleto1 = new Boleto(100.0);
        $boleto2 = new Boleto(200.0);

        $boletos = new ArrayObject();
        $boletos->append($boleto1);
        $boletos->append($boleto2);

        $processador->processa($boletos, $fatura);

        $this->assertEquals(2, count($fatura->getPagamentos()));

        $valor1 = $fatura->getPagamentos()[0]->getValor();
        $this->assertEquals(100.0, $valor1, null, 0.00001);

        $valor2 = $fatura->getPagamentos()[1]->getValor();
        $this->assertEquals(200.0, $valor2, null, 0.00001);
    }

    public function testNaoDeveMarcarFaturaComoPagoCasoBoletoUnicoMenorQueValorTotal()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura('Cliente', 150.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(100.0));

        $processador->processa($boletos, $fatura);

        $this->assertFalse($fatura->isPago());
    }

    public function testDeveMarcarFaturaComoPagoCasoBoletoUnicoPagueTudo()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura('Cliente', 150.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(150.0));

        $processador->processa($boletos, $fatura);

        $this->assertTrue($fatura->isPago());
    }

    public function testDeveMarcarFaturaComoPagoCasoBoletoUnicoPagueAMais()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura('Cliente', 150.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(200.0));

        $processador->processa($boletos, $fatura);

        $this->assertTrue($fatura->isPago());
    }

    public function testNaoDeveMarcarFaturaComoPagoCasoVariosBoletosMenorQueValorTotal()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura('Cliente', 200.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(100.0));
        $boletos->append(new Boleto(50.0));

        $processador->processa($boletos, $fatura);

        $this->assertFalse($fatura->isPago());
    }

    public function testDeveMarcarFaturaComoPagoCasoVariosBoletosComValorTotal()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura('Cliente', 200.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(100.0));
        $boletos->append(new Boleto(100.0));

        $processador->processa($boletos, $fatura);

        $this->assertTrue($fatura->isPago());
    }

    public function testDeveMarcarFaturaComoPagoCasoVariosBoletosComValorSuperior()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura('Cliente', 200.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(100.0));
        $boletos->append(new Boleto(100.0));
        $boletos->append(new Boleto(100.0));

        $processador->processa($boletos, $fatura);

        $this->assertTrue($fatura->isPago());
    }
}