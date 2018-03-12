<?php

namespace CDC\Loja\Persistencia;

use CDC\Loja\Produto\Produto;
use PDO;

class ProdutoDao
{
    private $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function adiciona(Produto $produto)
    {
        $sqlString = "INSERT INTO `produto` ";
        $sqlString .= "(nome, valor_unitario, status) ";
        $sqlString .= "VALUES (?,?,?)";

        $stmt = $this->conexao->prepare($sqlString);

        $stmt->bindParam(1, $produto->getNome());
        $stmt->bindParam(2, $produto->getValorUnitario());
        $stmt->bindParam(3, $produto->getQuantidade());

        $stmt->execute();

        return $this->conexao;
    }

    public function porId($id)
    {
        $sqlString = "SELECT * FROM `produto` WHERE id=".$id;
        $consulta = $this->conexao->query($sqlString);

        return $consulta->fetch($this->conexao->FETCH_ASSOC);
    }

    public function ativos()
    {
        $sqlString = "SELECT * FROM `produto` WHERE status=1";
        $consulta = $this->conexao->query($sqlString);

        return $consulta->fetchAll($this->conexao->FETCH_ASSOC);
    }
}