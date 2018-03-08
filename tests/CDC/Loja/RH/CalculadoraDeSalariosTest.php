<?php

namespace CDC\Loja\RH;

use CDC\Loja\Test\TestCase;

use CDC\Loja\RH\Funcionario,
    CDC\Loja\RH\TabelaCargos,
    CDC\Loja\RH\CalculadoraDeSalarios;


class CalculadoradeSalariosTest extends TestCase
{
    public function testCalculadoraDeSalarioDesenvolvedorComSalarioAbaixoDoLimite()
    {
        $calculadora = new CalculadoraDeSalarios();
        $desenvolvedor = new Funcionario('Rogério', 1500.0, TabelaCargos::DESENVOLVEDOR);

        $salario = $calculadora->calculaSalario($desenvolvedor);

        $this->assertEquals(1500.0 * 0.9, $salario, null, 0.00001);
    }  

    public function testCalculadoraDeSalarioDesenvolvedorComSalarioAcimaDoLimite()
    {
        $calculadora = new CalculadoraDeSalarios();
        $desenvolvedor = new Funcionario('Rogério', 4000.0, TabelaCargos::DESENVOLVEDOR);

        $salario = $calculadora->calculaSalario($desenvolvedor);

        $this->assertEquals(4000.0 * 0.8, $salario, null, 0.00001);
    }  

    public function testCalculadoraDeSalarioDBAComSalarioAbaixoDoLimite()
    {
        $calculadora = new CalculadoraDeSalarios();
        $desenvolvedor = new Funcionario('Rogério', 1500.0, TabelaCargos::DBA);

        $salario = $calculadora->calculaSalario($desenvolvedor);

        $this->assertEquals(1500.0 * 0.85, $salario, null, 0.00001);
    } 

    public function testCalculadoraDeSalarioDBAComSalarioAcimaDoLimite()
    {
        $calculadora = new CalculadoraDeSalarios();
        $desenvolvedor = new Funcionario('Rogério', 4500.0, TabelaCargos::DBA);

        $salario = $calculadora->calculaSalario($desenvolvedor);

        $this->assertEquals(4500.0 * 0.75, $salario, null, 0.00001);
    }   
}