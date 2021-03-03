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

} // END OF DOG CLASS


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

    public function addParent(string $childName, string $parentName): bool
    {
        foreach ($this->dogs as $child) {
            /** @var Dog $child */
            if ($child->getName() === $childName) {
                foreach ($this->dogs as $parent) {
                    /** @var Dog $parent */
                    if ($parent->getName() === $parentName) {
                        $child->setParent($parent->getName(), $parent->getSex());
                        return true;
                    }
                }
            }
        }
        return false;
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

} // END OF DOGS COLLECTION CLASS


// Create dogs
$dogs = new DogsCollection();
$dogs->addDogs([
    new Dog("Max", "male"),
    new Dog("Rocky", "male"),
    new Dog("Sparky", "male"),
    new Dog("Buster", "male"),
    new Dog("Sam", "male"),
    new Dog("Lady", "female"),
    new Dog("Molly", "female"),
    new Dog("Coco", "female")
]);


// Add mothers and fathers
echo $dogs->addParent("Max", "Lady") ? "Parent added!\n" : "Parent not added!\n";
echo $dogs->addParent("Max", "Rocky") ? "Parent added!\n" : "Parent not added!\n";
echo PHP_EOL;
echo $dogs->addParent("Coco", "Molly") ? "Parent added!\n" : "Parent not added!\n";
echo $dogs->addParent("Coco", "Buster") ? "Parent added!\n" : "Parent not added!\n";
echo PHP_EOL;
echo $dogs->addParent("Rocky", "Molly") ? "Parent added!\n" : "Parent not added!\n";
echo $dogs->addParent("Rocky", "Sam") ? "Parent added!\n" : "Parent not added!\n";
echo PHP_EOL;
echo $dogs->addParent("Buster", "Lady") ? "Parent added!\n" : "Parent not added!\n";
echo $dogs->addParent("Buster", "Sparky") ? "Parent added!\n" : "Parent not added!\n";


// Return fathers name
echo $dogs->getFatherName("Coco");      // Buster
echo $dogs->getFatherName("Sparky");    // Unknown
echo $dogs->getFatherName("Abc");       // Abc is not in the dogs list
echo PHP_EOL;

// Check siblings
echo $dogs->hasSameMotherAs("Coco", "Rocky") ? "They are siblings.\n" : "They are not siblings.\n";     // yes, yes
echo $dogs->hasSameMotherAs("Sparky", "Sam") ? "They are siblings.\n" : "They are not siblings.\n";     // unknown, unknown
echo $dogs->hasSameMotherAs("Coco", "Sam") ? "They are siblings.\n" : "They are not siblings.\n";       // yes, unknown