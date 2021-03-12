<?php


class Track
{
    private string $name;
    private int $length;

    // track is: 20 chars before + 1 char start + "TRACK LENGTH" + 1 chart finish line + 1 over
    // need constants to be able to translate correct distances for item positioning on track
    private const TRACK_OFFSET = 20;
    private const TRACK_OFFSET_START = 21;
    private const TRACK_OFFSET_FINISH = 23;

    public function __construct(string $name, int $length)
    {
        $this->name = $name;
        $this->length = $length;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getTrackOffset(): int
    {
        return self::TRACK_OFFSET;
    }

    public function getTrackOffsetStart(): int
    {
        return self::TRACK_OFFSET_START;
    }

    public function getTrackOffsetFinish(): int
    {
        return self::TRACK_OFFSET_FINISH;
    }
}