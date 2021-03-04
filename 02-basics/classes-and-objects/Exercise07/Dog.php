<?php


class Dog
{
    private string $name;
    private string $sex;
    private string $mother;
    private string $father;

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
        return isset($this->father) ? $this->father : "Unknown";
    }

    public function getMotherName(): string
    {
        return isset($this->mother) ? $this->mother : "Unknown";
    }

    public function setParent(string $name, string $sex): void
    {
        $sex === "female" ? $this->mother = $name : $this->father = $name;
    }

}