<?php


class Dog
{
    private string $name;
    private string $sex;
    private Dog $mother;
    private Dog $father;
    const MALE = "male";
    const FEMALE = "female";

    public function __construct(string $name, string $sex)
    {
        $this->name = $name;
        $this->sex = $sex;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function getFatherName(): string
    {
        return isset($this->father) ? $this->father->getName() : "Unknown";
    }

    public function getMotherName(): string
    {
        return isset($this->mother) ? $this->mother->getName() : "Unknown";
    }

    public function setParent(Dog $dog): void
    {
        ($dog->getSex() === "female") ? ($this->mother = $dog) : ($this->father = $dog);
    }

}