<?php

class Point
{
    private string $x;
    private string $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }
}

class Swap
{
    public static function swapPoints(Point $p1, Point $p2): void
    {
        $tempX = $p1->getX();
        $tempY = $p1->getY();
        $p1->setX($p2->getX());
        $p1->setY($p2->getY());
        $p2->setX($tempX);
        $p2->setY($tempY);
    }
}

$p1 = new Point(5, 2);
$p2 = new Point(-3, 6);

Swap::swapPoints($p1, $p2);

echo "({$p1->getX()}, {$p1->getY()})" . PHP_EOL;
echo "({$p2->getX()}, {$p2->getY()})" . PHP_EOL;

