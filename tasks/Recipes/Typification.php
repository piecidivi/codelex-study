<?php


abstract class Typification
{
    protected string $name;
    protected string $type;

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }
}