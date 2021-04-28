<?php

namespace Tests\Models;

use App\Models\History;
use PHPUnit\Framework\TestCase;

class HistoryTest extends TestCase
{
    public function testId(): void
    {
        $history = new History(2, 5, "Jane", "yes", 1, "2021-04-28");
        $this->assertEquals(1, $history->id());
    }

    public function testUserId(): void
    {
        $history = new History(2, 5, "Jane", "yes", 1, "2021-04-28");
        $this->assertEquals(2, $history->userid());
    }

    public function testCheckedId(): void
    {
        $history = new History(2, 5, "Jane", "yes", 1, "2021-04-28");
        $this->assertEquals(5, $history->checkedId());
    }

    public function testCheckedName(): void
    {
        $history = new History(2, 5, "Jane", "yes", 1, "2021-04-28");
        $this->assertEquals("Jane", $history->checkedName());
    }

    public function testLiked(): void
    {
        $history = new History(2, 5, "Jane", "yes", 1, "2021-04-28");
        $this->assertEquals("yes", $history->liked());
    }

    public function testCreated(): void
    {
        $history = new History(2, 5, "Jane", "yes", 1, "2021-04-28");
        $this->assertEquals("2021-04-28", $history->created());
    }
}