<?php


class VideoStore
{
    private array $videos = [];

    public function getVideoList(): array
    {
        return $this->videos;
    }

    public function getAvailableForRent(): array
    {
        return array_filter($this->videos, function (Video $video): bool {
            return $video->availableInStore();
        });
    }

    // Only video that is rented out can be returned to store
    public function getRentedOut(): array
    {
        return array_filter($this->videos, function (Video $video): bool {
            return !$video->availableInStore();
        });
    }

    public function addVideo(Video $video): void
    {
        $this->videos[] = $video;
    }

    public function rentVideo(string $title): void
    {
        foreach ($this->videos as $video) {
            /** @var Video $video */
            if ($video->getTitle() === $title) $video->checkOut();
        }
    }

    public function returnVideoToStore(string $title, int $rating): void
    {
        foreach ($this->videos as $video) {
            /** @var Video $video */
            if ($video->getTitle() === $title) $video->returnToStore($rating);
        }
    }
}