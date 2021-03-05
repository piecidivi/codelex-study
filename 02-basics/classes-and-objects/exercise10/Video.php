<?php


class Video
{
    private string $title;
    private bool $availableInStore = true;
    private array $rating = [];

    public function __construct(string $title, int $rating)
    {
        $this->title = $title;
        $this->setRating($rating);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function availableInStore(): bool
    {
        return $this->availableInStore;
    }

    public function getRating(): int
    {
        // This would be impossible to reach. However, just for safety.
        if (count($this->rating) < 1) {
            return 0;
        }
        return array_sum($this->rating) / count($this->rating);
    }

    public function checkOut(): void
    {
        $this->availableInStore = false;
    }

    public function returnToStore(int $rating): void
    {
        $this->setRating($rating);
        $this->availableInStore = true;
    }

    // Rating would be float between 0 and 10, so we multiply to work with int, and then divide on output.
    private function setRating(int $rating): void
    {
        $this->rating[] = $rating * 100;
    }
}