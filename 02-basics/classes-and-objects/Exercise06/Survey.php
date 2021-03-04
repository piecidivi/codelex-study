<?php


class Survey
{
    private int $surveyedTotal;
    private float $energyDrinksPercent;
    private float $citrusDrinksPercent;     // Out of those purchasing energyDrinks

    public function __construct(int $surveyedTotal, float $energyDrinksPercent, float $citrusDrinksPercent)
    {
        $this->setSurveyValues($surveyedTotal, $energyDrinksPercent, $citrusDrinksPercent);
    }

    // Required "Logic Exception". If we had to divide by zero in sub-method, then maybe we could find some "Logic Exception".
    // However, here we only have to multiply.
    private function setSurveyValues(int $surveyedTotal, float $energyDrinksPercent, float $citrusDrinksPercent): void
    {
        if ($surveyedTotal < 0 || $energyDrinksPercent < 0 || $citrusDrinksPercent < 0) {
            throw new InvalidArgumentException("Ambiguous values provided.\n");
        }
        $this->surveyedTotal = $surveyedTotal;
        $this->energyDrinksPercent = $energyDrinksPercent;
        $this->citrusDrinksPercent = $citrusDrinksPercent;
    }

    public function getSurveyed(): int
    {
        return $this->surveyedTotal;
    }

    public function getEnergyDrinksRate(): int
    {
        return intval($this->surveyedTotal * $this->energyDrinksPercent);
    }

    public function getCitrusDrinksRate(): int
    {
        return intval($this->surveyedTotal * $this->energyDrinksPercent * $this->citrusDrinksPercent);
    }

}