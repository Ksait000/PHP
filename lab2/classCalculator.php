<?php

class Calculator
{
    private $result = 0;

    public function sum(float $value)
    {
        $this->result += $value;
        return $this;
    }

    public function minus(float $value)
    {
        $this->result -= $value;
        return $this;
    }

    public function product(float $value)
    {
        $this->result *= $value;
        return $this;
    }

    public function division(float $value)
    {
        if ($value == 0) {
            throw new Exception("Деление на ноль.");
        } else {
            $this->result /= $value;
            return $this;
        }
    }

    public function getResult()
    {
        return $this->result;
    }
}


$calculator = new Calculator();

try {
    print($calculator->sum(2)->minus(1)->division(0)->product(3)->getResult()); //->sum(3)->minus(2)->division(2)->product(3)->getResult());
} catch (Exception $e) {
    print("Выброшено исключение: " .  $e->getMessage() . "\n");
}
