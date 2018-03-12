<?php

namespace CDC\Loja\Persistencia;

use CDC\Loja\Persistencia\ConexaoComBancoDeDados;
use CDC\Loja\Persistencia\ProdutoDao;
use CDC\Loja\Produto\Produto;
use CDC\Loja\Test\TestCase;
use PDO;
    
error_reporting(E_STRICT);

class ProdutoDaoTest extends TestCase
{

    private $conexao;

    public function setUp()
    {
        parent::setUp();

        $this->conexao = new PDO('sqlite:/tmp/test.db');

        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->criaTabela();
    }

    protected function criaTabela()
    {
        $sqlString = "CREATE TABLE produto ";
        $sqlString .= "(id INTEGER PRIMARY KEY, nome TEXT, ";
        $sqlString .= "valor_unitario TEXT, status TINYINT(1) );";

        $this->conexao->query($sqlString);
    }

    protected function tearDown()
    {
        parent::tearDown();
        unlink('/tmp/test.db');
    }

    public function testDeveAdicionarUmProduto()
    {
        //$conn = (new ConexaoComBancoDeDados())->getConexao();

        $produtoDao = new ProdutoDao($this->conexao);

        $produto = new Produto('Geladeira', 150.0, 1);

        //Sobrescrevendo a conexão para continuar trabalhando sobre a mesma já instanciada
        $this->conexao = $produtoDao->adiciona($produto);

        //Buscando pelo id para ver se está igual o produto do cenário
        $salvo = $produtoDao->porId($this->conexao->lastInsertId());

        $this->assertEquals($salvo['nome'], $produto->getNome());
        $this->assertEquals($salvo['valor_unitario'], $produto->getValorUnitario());
        $this->assertEquals($salvo['status'], $produto->getQuantidade());
    }
}