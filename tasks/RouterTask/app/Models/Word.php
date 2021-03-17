<?php

namespace App\Models;

class Word
{
    private string $word;

    public function __construct(string $word)
    {
        $this->word = $word;
    }

    public function getChangedWord(): string
    {
        $str = "";
        for ($i = 0; $i < strlen($this->word); ++$i) {
            if (ctype_upper($this->word[$i])) {
                $str .= strtolower($this->word[$i]);
            } else {
                $str .= strtoupper($this->word[$i]);
            }
        }
        return $str;
    }
}