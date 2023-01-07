<?php

class Calculator
{
    private float $result = 0;

    public function sum(float $value): self
    {
        $this->result += $value;
        return $this;
    }

    public function minus(float $value): self
    {
        $this->result -= $value;
        return $this;
    }

    public function product(float $value): self
    {
        $this->result *= $value;
        return $this;
    }

    public function division(float $value): self
    {
        if ($value == 0) {
            throw new Exception("Деление на ноль.");
        } else {
            $this->result /= $value;
            return $this;
        }
    }

    public function getResult(): float
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
