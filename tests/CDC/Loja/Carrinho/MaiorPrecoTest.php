<?php

namespace CDC\Loja\Carrinho;

use CDC\Loja\Carrinho\CarrinhoDeCompras;
use CDC\Loja\Produto\Produto;
use CDC\Loja\Test\TestCase;

class MaiorPrecoTest extends TestCase
{
    public function testDeveRetornarZeroSeCarrinhoVazio() 
    {
        $carrinho = new CarrinhoDeCompras();

        $valor = $carrinho->maiorValor();

        $this->assertEquals(0, $valor, null, 0,0001);
    }

    public function testDeveRetornarValorDoItemSeCarrinhoCom1Elemento() 
    {
        $carrinho = new CarrinhoDeCompras();
        $carrinho->adiciona(new Produto("Geladeira", 900.0, 1));

        $valor = $carrinho->maiorValor();

        $this->assertEquals(900.0, $valor, null, 0,0001);
    }

    public function testDeveRetornarMaiorValorSeCarrinhoComMuitosElementos() 
    {
        $carrinho = new CarrinhoDeCompras();
        $carrinho->adiciona(new Produto("Geladeira", 900.0, 1));
        $carrinho->adiciona(new Produto("Fogão", 1500.0, 1));
        $carrinho->adiciona(new Produto("Máquina de Lavar", 750.0, 1));

        $valor = $carrinho->maiorValor();

        $this->assertEquals(1500.0, $valor, null, 0,0001);
    }
}