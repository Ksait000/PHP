<?php

class Square extends Shape
{
    private float $side;

    public function __construct(float $side)
    {
        $this->side = $side;
    }

    public function getPerimeter(): float
    {
        return $this->side * 4;
    }

    public function getArea(): float
    {
        return $this->side * $this->side;
    }
}
