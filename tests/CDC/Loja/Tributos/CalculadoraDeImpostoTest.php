<?php

namespace CDC\Loja\Tributos;

use CDC\Loja\Tributos\Tabela;
use CDC\Loja\FluxoDeCaixa\Pedido;
use CDC\Loja\Tributos\CalculadoraDeImposto;
use CDC\Loja\Test\TestCase;

use Mockery;

class CalculadoraDeImpostoTest extends TestCase
{
    public function testCalculoImpostoParaPedidosSuperiorA2000Reais()
    {
        $tabela = Mockery::mock(Tabela::class);

        //Ensinando o mock a devolver 0.1 caso o método para Valor seja invocado com o valor 2500
        $tabela->shouldReceive('paraValor')->with(2500.0)->andReturn(0.1);

        $pedido = new Pedido('Rogério', 2500.0, 3);
        $calculadora = new CalculadoraDeImposto($tabela);

        $valor = $calculadora->calculaImpostos($pedido);

        $this->assertEquals((2500.0 * 0.1), $valor, null, 0.00001);
    }
}