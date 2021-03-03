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

    // Uzdevumā prasīts ir "Logic Exception", bet tas ir tādam gadījumam, ja kodā ir loģiska kļūda.
    // Dotajā uzdevumā pēc tām prasībām un piedāvātā sākuma koda nekādu loģisku kļūdu izdomāt nesanāk.
    // Varētu kaut ko izdomāt, ja kaut kur pa vidu dabūtu nulli, ar kuru dalītu pakārtotajā metodē, bet te jau ir tikai jāreizina.
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

// Create instance
try {
    $surveyed = new Survey(12467, 0.14, 0.64);
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage();
}

// Retrieve data
if (isset($surveyed)) {
    echo "Total number of people surveyed: {$surveyed->getSurveyed()}.\n";
    echo "Approximately {$surveyed->getEnergyDrinksRate()} bought at least one energy drink.\n";
    echo "{$surveyed->getCitrusDrinksRate()} of those prefer flavored energy drinks.\n";
}