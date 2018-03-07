<?php

namespace CDC\Loja\RH;

use CDC\Loja\RH\Funcionario;

class CalculadoraDeSalarios
{
    public function calculaSalario(Funcionario $funcionario)
    {
        if($funcionario->getSalario() > 3000)
            return $funcionario->getSalario() * 0.8;

        return $funcionario->getSalario() * 0.9;
    }
}