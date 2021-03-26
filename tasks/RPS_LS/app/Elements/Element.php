<?php

namespace App\Elements;

interface Element
{
    public function name(): string;

    public function picture(): string;

    public function winner(string $opponent): bool;
}