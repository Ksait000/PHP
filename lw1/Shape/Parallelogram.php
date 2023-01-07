<?php

class Parallelogram extends Shape
{
    private float $slantingSide;
    private float $horizontalSide;
    private float $height;

    public function __construct(float $slantingSide, float $horizontalSide, float $height)
    {
        $this->slantingSide = $slantingSide;
        $this->horizontalSide = $horizontalSide;
        $this->height = $height;

        if ($this->getPerimeter()/$horizontalSide != $height)
        {
            throw new Exception("Высота неправильная!");
        }
        
    }

    public function getPerimeter(): float
    {
        return 2 * ($this->slantingSide + $this->horizontalSide);
    }

    public function getArea(): float
    {
        return $this->horizontalSide * $this->height;
    }
}
