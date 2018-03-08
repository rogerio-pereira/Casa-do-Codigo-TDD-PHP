<?php

namespace CDC\Loja\FluxoDeCaixa;

class Pedido
{
    private $cliente;
    private $valorTotal;
    private $quantidadeItems;

    public function __construct($cliente, $valorTotal, $quantidadeItems)
    {
        $this->cliente = $cliente;
        $this->valorTotal = $valorTotal;
        $this->quantidadeItems = $quantidadeItems;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    public function getQuantidadeItems()
    {
        return $this->quantidadeItems;
    }
}