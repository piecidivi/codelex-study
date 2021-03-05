<?php


class DogsCollection
{
    private array $dogs = [];


    public function addDogs(array $dogs): void
    {
        foreach ($dogs as $dog) {
            $this->add($dog);
        }
    }

    private function add(Dog $dog): void
    {
        $this->dogs[] = $dog;
    }

    public function addParent(string $childName, string $parentName): void
    {
        foreach ($this->dogs as $child) {
            /** @var Dog $child */
            if ($child->getName() === $childName) {
                foreach ($this->dogs as $parent) {
                    /** @var Dog $parent */
                    if ($parent->getName() === $parentName) {
                        $child->setParent($parent);
                    }
                }
            }
        }
    }

    public function getFatherName(string $childName): string
    {
        foreach ($this->dogs as $child) {
            /** @var Dog $child */
            if ($child->getName() === $childName) {
                return "{$child->getName()}'s father's name is {$child->getFatherName()}.\n";
            }
        }
        return "{$childName} not found in list.\n";
    }

    public function hasSameMotherAs(string $childName1, string $childName2): bool
    {
        foreach ($this->dogs as $child1) {
            /** @var Dog $child1 */
            if ($child1->getName() === $childName1 && $child1->getMotherName() !== "Unknown") {
                foreach ($this->dogs as $child2) {
                    /** @var Dog $child2 */
                    if ($child2->getName() === $childName2 && $child2->getMotherName() !== "Unknown") {
                        return $child1->getMotherName() === $child2->getMotherName();
                    }
                }
            }
        }
        return false;
    }
}