<?php

class Rectangle extends Shape
{
    private float $width;
    private float $height;

    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getPerimeter(): float
    {
        return $this->width * 2 + $this->height * 2;
    }

    public function getArea(): float
    {
        return $this->width * $this->height;
    }
}
