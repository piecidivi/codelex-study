<?php

interface Racer
{
    public function getID(): string;
    public function getName(): string;
    public function getSpeed(): int;
    public function getCrashRate(): int;
}