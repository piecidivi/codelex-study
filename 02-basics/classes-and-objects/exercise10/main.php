<?php

require_once "Video.php";
require_once "VideoStore.php";


// Testing Video Store
$videoStore = new VideoStore();


// Adding 3 videos
$videoStore->addVideo(new Video("The Matrix", 7));
$videoStore->addVideo(new Video("Godfather II", 8));
$videoStore->addVideo(new Video("Star Wars Episode IV: A New Hope", 7));


// Renting
$videoStore->rentVideo("The Matrix");
$videoStore->rentVideo("Godfather II");
$videoStore->rentVideo("Star Wars Episode IV: A New Hope");


// Return to store with added new ratings
$videoStore->returnVideoToStore("The Matrix", 10);
$videoStore->returnVideoToStore("Godfather II", 9);
$videoStore->returnVideoToStore("Star Wars Episode IV: A New Hope", 9);


// Rent out "Godfather II"
$videoStore->rentVideo("Godfather II");


// List inventory
$inventory = $videoStore->getVideoList();
$iterator = 1;
foreach ($inventory as $item) {
    /** @var Video $item */

    echo "{$item->getTitle()}, rating is " . number_format($item->getRating() / 100, 1) . ", video is ";
    echo $item->getState() ? "available " : "not available ";
    echo "for rent\n";
}