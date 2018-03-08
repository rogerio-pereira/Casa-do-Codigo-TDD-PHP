<?php

namespace CDC\Loja\RH;

use CDC\Loja\RH\Funcionario;
use CDC\Loja\RH\RegraDeCalculo;

class DezOuVintePorCento implements RegraDeCalculo
{
    public function calcula(Funcionario $funcionario)
    {
        if($funcionario->getSalario() > 3000)
            return $funcionario->getSalario() * 0.8;

        return $funcionario->getSalario() * 0.9;
    }
}