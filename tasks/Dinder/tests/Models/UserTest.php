<?php

namespace Tests\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testId(): void
    {
        $user = new User("abc@abc.lv", "abcdefg123", 1,
            "Jane", "F", "A", "dummy.jpg", "original.jpg");
        $this->assertEquals(1, $user->id());
    }

    public function testEmail(): void
    {
        $user = new User("abc@abc.lv", "abcdefg123", 1,
            "Jane", "F", "A", "dummy.jpg", "original.jpg");
        $this->assertEquals("abc@abc.lv", $user->email());
    }

    public function testPassword(): void
    {
        $user = new User("abc@abc.lv", "abcdefg123", 1,
            "Jane", "F", "A", "dummy.jpg", "original.jpg");
        $this->assertEquals("abcdefg123", $user->password());
    }

    public function testName(): void
    {
        $user = new User("abc@abc.lv", "abcdefg123", 1,
            "Jane", "F", "A", "dummy.jpg", "original.jpg");
        $this->assertEquals("Jane", $user->name());
    }

    public function testSex(): void
    {
        $user = new User("abc@abc.lv", "abcdefg123", 1,
            "Jane", "F", "A", "dummy.jpg", "original.jpg");
        $this->assertEquals("F", $user->sex());
    }

    public function testPreference(): void
    {
        $user = new User("abc@abc.lv", "abcdefg123", 1,
            "Jane", "F", "A", "dummy.jpg", "original.jpg");
        $this->assertEquals("A", $user->preference());
    }

    public function testImagePath(): void
    {
        $user = new User("abc@abc.lv", "abcdefg123", 1,
            "Jane", "F", "A", "dummy.jpg", "original.jpg");
        $this->assertEquals("dummy.jpg", $user->imagePath());
    }

    public function testOriginalImageName(): void
    {
        $user = new User("abc@abc.lv", "abcdefg123", 1,
            "Jane", "F", "A", "dummy.jpg", "original.jpg");
        $this->assertEquals("original.jpg", $user->originalImageName());
    }
}