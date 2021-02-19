<?php

function freeFallDistance(float $acceleration, float $time, float $initialVelocity, float $initialPosition): float
{
    return 0.5 * $acceleration * $time ** 2 + $initialVelocity * $time + $initialPosition;
}

printf("%.2f\n", freeFallDistance(-9.81, 10, 0, 0));