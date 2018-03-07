<?php

namespace CDC\Loja\Test;

use CDC\Loja\Carrinho\CarrinhoDeCompras;
use CDC\Loja\Produto\Produto;


/*
 * para instanciar um novo carrinho 
 * 
 * $carrinho = (new CarrinhoDeComprasBuilder())
 *                 ->comItens(200.0, 300) //Valores de Cada item
 *                 ->cria();
 */
class CarrinhoDeComprasBuilder
{
    public $carrinho;

    public function __construct()
    {
        $this->carrinho = new CarrinhoDeCompras();
    }

    public function comItems()
    {
        $valores = func_get_args();

        foreach ($valores as $valor) {
            $this->carrinho->adiciona(new Produto("Item", $valor, 1));
        }

        return $this;
    }

    public function cria()
    {
        return $this->carrinho();
    }
}