<?php


class Warehouse
{
    protected string $name;
    protected array $flowers = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getFlowers(): array
    {
        return $this->flowers;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalAmount(): int
    {
        $amount = 0;
        foreach ($this->flowers as $flower) {
            /** @var Flower $flower */
            $amount += $flower->getAmount();
        }
        return $amount;
    }

    public function getAvailableFlowers(): array
    {
        return array_values(array_filter($this->flowers, function (Flower $flower) {
            return $flower->getAmount() > 0;
        }));
    }

    public function getFlowerNames(): array
    {
        $names = [];
        foreach ($this->flowers as $flower) {
            /** @var Flower $flower */
            $names[] = $flower->getName();
        }
        return $names;
    }

    public function addFlowers(array $flowers): void
    {
        foreach ($flowers as $flower) {
            $this->addOneFlower($flower);
        }
    }

    public function addOneFlower(Flower $flower): void
    {
        $this->flowers[] = $flower;
    }

    public function transferFlowers(Warehouse $warehouse): void
    {
        foreach ($this->flowers as $flower) {
            foreach ($warehouse->flowers as $soldFlower) {
                /** @var Flower $flower */
                /** @var Flower $soldFlower */
                if ($flower->getName() === $soldFlower->getName()) {
                    $flower->addAmount($soldFlower->getAmount());
                }
            }
        }
    }

    public function deductAmount(string $name, int $amount): void
    {
        foreach ($this->getAvailableFlowers() as $flower) {
            /** @var Flower $flower */
            if ($flower->getName() === $name) {
                $flower->deductAmount($amount);
            }
        }
    }
}