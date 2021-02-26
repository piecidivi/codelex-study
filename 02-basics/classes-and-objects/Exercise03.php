<?php

// Filling up, and driving to 0 is controlled by FuelGauge tankStatus property.

class FuelGauge
{
    private int $fuel = 0;

    public function getFuelAmount(): int
    {
        return $this->fuel;
    }

    public function tankStatus(string $activity): bool
    {
        return ($activity === "fill" && $this->fuel < 70) ||
            ($activity === "drive" && $this->fuel > 0);
    }

    public function putFuel(): void
    {
        $this->fuel++;
    }

    public function useFuel(): void
    {
        $this->fuel--;
    }

}

class Odometer
{
    private int $mileage;
    private int $run = 0;

    public function __construct(int $mileage)
    {
        if ($mileage > 999999) {
            throw new InvalidArgumentException("Max mileage allowed 999,999 km.");
        }
        $this->mileage = $mileage;
    }

    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function drive(FuelGauge $fuel): void
    {
        $this->mileage++;
        if ($this->mileage > 999999) {
            $this->mileage = 0;
        }
        $this->run++;
        if ($this->run === 10) {
            $this->run = 0;
            $fuel->useFuel();
        }
    }
}

try {
    $odometer = new Odometer(999895);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
    return;
}

$fuelGauge = new FuelGauge();
while ($fuelGauge->tankStatus("fill")) {
    $fuelGauge->putFuel();
    echo "Filling fuel tank: {$fuelGauge->getFuelAmount()}" . PHP_EOL;
}

echo PHP_EOL;
while ($fuelGauge->tankStatus("drive")) {
    $odometer->drive($fuelGauge);
    echo "Current mileage: {$odometer->getMileage()}, amount of fuel: {$fuelGauge->getFuelAmount()}" . PHP_EOL;
}