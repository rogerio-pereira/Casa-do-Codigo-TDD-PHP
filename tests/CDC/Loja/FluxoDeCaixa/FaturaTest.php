<?php

namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\Fatura;
use CDC\Loja\FluxoDeCaixa\Boleto;
use CDC\Loja\FluxoDeCaixa\ProcessadorDeBoletos;
use CDC\Loja\Test\TestCase;

use ArrayObject;

class FaturaTest extends TestCase
{
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