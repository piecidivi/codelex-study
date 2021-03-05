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


// Add parents
$dogs->addParent("Max", "Lady");
$dogs->addParent("Max", "Rocky");
$dogs->addParent("Coco", "Molly");
$dogs->addParent("Coco", "Buster");
$dogs->addParent("Rocky", "Molly");
$dogs->addParent("Rocky", "Sam");
$dogs->addParent("Buster", "Lady");
$dogs->addParent("Buster", "Sparky");


// Return fathers name
echo PHP_EOL;
echo $dogs->getFatherName("Coco");      // Buster
echo $dogs->getFatherName("Sparky");    // Unknown
echo $dogs->getFatherName("Abc");       // Abc is not in the dogs list
echo PHP_EOL;

// Check siblings
echo $dogs->hasSameMotherAs("Coco", "Rocky") ? "They are siblings.\n" : "They are not siblings.\n";     // yes, yes
echo $dogs->hasSameMotherAs("Sparky", "Sam") ? "They are siblings.\n" : "They are not siblings.\n";     // unknown, unknown
echo $dogs->hasSameMotherAs("Coco", "Sam") ? "They are siblings.\n" : "They are not siblings.\n";       // yes, unknown