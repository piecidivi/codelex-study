<?php


class UnitType
{
    private string $name;
    private string $type;
    private string $amount;
    const COUNT = "count";
    const WEIGHT = "weight";
    const VOLUME = "volume";


    public function __construct(string $name, int $type, int $amount) {
        $this->name = $name;
        $this->setType($type);
        $this->setAmount($amount);
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getAmount(): int {
        return $this->amount;
    }

    private function setType(int $type): void {
        if ($type === 1) $this->type = self::COUNT;     // Pieces, countable
        if ($type === 2) $this->type = self::WEIGHT;     // Weighable
        if ($type === 3) $this->type = self::VOLUME;      // Volume
    }

    private function setAmount(int $amount): void {
        $this->amount = $amount;
    }
}