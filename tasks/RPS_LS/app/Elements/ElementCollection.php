<?php

namespace App\Elements;

class ElementCollection
{
    private array $elements = [];

    public function __construct(array $elements)
    {
        $this->addElements($elements);
    }

    public function elements(): array
    {
        return $this->elements;
    }

    public function getElementByName(string $name): Element
    {
        foreach ($this->elements as $element) {
            /** @var Element $element */
            if ($element->name() === $name) {
                return $element;
            }
        }
    }

    private function addElements(array $elements): void
    {
        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    private function add(Element $element): void
    {
        $this->elements[] = $element;
    }
}