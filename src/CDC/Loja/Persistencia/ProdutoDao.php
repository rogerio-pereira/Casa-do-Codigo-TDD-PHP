<?php

namespace CDC\Loja\Persistencia;

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
        $sqlString = "INSERT INTO 'produtos' ";
        $sqlString .= "(descricao, valor_unitario, status) ";
        $sqlString .= "VALUES (?,?,?)";

        $stmt = $this->conexao->prepare($sqlString);

        $stmt->bindParam(1, $produto->getDescricao());
        $stmt->bindParam(2, $produto->getValorUnitario());
        $stmt->bindParam(3, $produto->getStatus());

        $stmt->execute();

        return $this->conexao;
    }

    public function porId()
    {
        $sqlString = "SELECT * FROM 'produto' WHERE id=".$id;
        $consulta = $this->conexao->query($sqlString);

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function ativos()
    {
        $sqlString = "SELECT * FROM 'produto' WHERE status=1";
        $consulta = $this->conexao->query($sqlString);

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }
}