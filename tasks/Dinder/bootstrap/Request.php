<?php

namespace Bootstrap;

class Request
{
    private array $request = [];
    private array $image = [];

    public function getInput(): array
    {
        return $this->request;
    }

    public function getFile(): array
    {
        return $this->image;
    }

    public function fillInput(array $request, string $keyPrefix): void
    {
        foreach ($request as $key => $element) {
            $storeKey = $keyPrefix . $key;
            $this->request[$storeKey] = trim($element);
        }
    }

    public function uploadFile(array $image): void
    {
        foreach ($image as $img) {
            foreach ($img as $key => $element) {
                $this->image[$key] = $element;
            }
        }
    }
}