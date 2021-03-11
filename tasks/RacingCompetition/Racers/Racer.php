<?php

interface Racer
{
    public function getID(): int;
    public function getName(): string;
    public function getSpeed(): int;
    public function getCrashRate(): int;
}