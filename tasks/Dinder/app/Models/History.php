<?php

namespace App\Models;

use JsonSerializable;

class History implements JsonSerializable
{
    private int $id;
    private int $userid;
    private int $checkedId;
    private string $checkedName;
    private string $liked;
    private string $created;

    public function __construct(
        int $userid,
        int $checkedId,
        string $checkedName,
        string $liked,
        int $id = -1,
        string $created = ""
    )
    {
        $this->userid = $userid;
        $this->checkedId = $checkedId;
        $this->checkedName = $checkedName;
        $this->liked = $liked;
        $this->id = $id;
        $this->created = $created;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function userid(): int
    {
        return $this->userid;
    }

    public function checkedId(): int
    {
        return $this->checkedId;
    }

    public function checkedName(): string
    {
        return $this->checkedName;
    }

    public function liked(): string
    {
        return $this->liked;
    }

    public function created(): string
    {
        return $this->created;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}