<?php


class VideoStore
{
    private array $videos = [];

    public function getVideoList(): array
    {
        return $this->videos;
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