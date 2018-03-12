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
}