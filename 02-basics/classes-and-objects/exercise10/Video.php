<?php


class Video
{
    private string $title;
    private bool $availableInStore = true;
    private int $rating = 0;
    private int $ratingCount = 0;   // Need this to update average rating. If we put it in one array, then we have possible type-hint problem for array.

    public function __construct(string $title, int $rating)
    {
        $this->title = $title;
        $this->setRating($rating);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getState(): bool
    {
        return $this->availableInStore;
    }

    public function getRating(): int
    {
        return $this->rating;
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
        $this->ratingCount++;   // Here we avoid dividing by 0 on first rating event.
        $this->rating = (($this->rating + $rating * 100) / $this->ratingCount);
    }

}