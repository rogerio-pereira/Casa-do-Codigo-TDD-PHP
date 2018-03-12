<?php

namespace CDC\Loja\Persistencia;

use CDC\Loja\Persistencia\ConexaoComBancoDeDados;
use CDC\Loja\Persistencia\ProdutoDao;
use CDC\Loja\Produto\Produto;
use CDC\Loja\Test\TestCase;

class ProdutoDaoTest extends TestCase
{
    public function testDeveAdicionarUmProduto()
    {
        $conn = (new ConexaoComBancoDeDados())->getConexao();

        $produtoDao = new ProdutoDao($conn);

        $produto = new Produto('Geladeira', 150.0);

        $produtoDao->adiciona($produto);

        //Como Validar
    }
}