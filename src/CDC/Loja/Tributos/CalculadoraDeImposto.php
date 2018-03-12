<?php

namespace CDC\Loja\Tributos;

use CDC\Loja\FluxoDeCaixa\Pedido;
use CDC\Loja\Tributos\Tabela;

class CalculadoraDeImposto
{
    protected $tabela;

    public function __construct(Tabela $tabela)
    {
        $this->tabela = $tabela;
    }

    public function calculaImpostos(Pedido $pedido)
    {
        $taxa = $this->tabela->paraValor($pedido->getValorTotal());

        return $pedido->getValorTotal() * $taxa;
    }
}