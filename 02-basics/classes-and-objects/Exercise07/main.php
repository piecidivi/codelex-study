<?php

require_once "Dog.php";
require_once  "DogsCollection.php";

// Create dogs
$dogs = new DogsCollection();
$dogs->addDogs([
    new Dog("Max", Dog::MALE),
    new Dog("Rocky", Dog::MALE),
    new Dog("Sparky", Dog::MALE),
    new Dog("Buster", Dog::MALE),
    new Dog("Sam", Dog::MALE),
    new Dog("Lady", Dog::FEMALE),
    new Dog("Molly", Dog::FEMALE),
    new Dog("Coco", Dog::FEMALE)
]);


// Add mothers and fathers (returns boolean for testing purposes)
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