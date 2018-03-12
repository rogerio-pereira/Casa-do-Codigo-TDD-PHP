<?php

namespace CDC\Loja\Persistencia;

class ConexaoComBancoDeDados
{
    public function getConexao()
    {
        return new PDO("mysql:host=;dbname=", "", "");
    }
}