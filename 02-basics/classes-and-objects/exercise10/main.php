<?php

require_once "Video.php";
require_once "VideoStore.php";

// Functions for testing
// Main menu
function mainMenu(): string
{
    return "\nChoose the operation you want to perform \n" .
        "Choose 0 for EXIT\n" .
        "Choose 1 to fill video store\n" .
        "Choose 2 to rent video (as user)\n" .
        "Choose 3 to return video (as user)\n" .
        "Choose 4 to list inventory\n";
}

// Rent video menu
function chooseVideo(array $videoStore): string
{
    $output = "\n";
    foreach ($videoStore as $key => $video) {
        /** @var Video $video */
        $output .= " [" . ($key + 1) . "] {$video->getTitle()}\n";
    }
    return $output;
}

// List inventory menu
function listInventory(array $videoStore): string
{
    $output = "";
    foreach ($videoStore as $video) {
        /** @var Video $video */
        $output .= "{$video->getTitle()}, rating is " . number_format($video->getRating() / 100, 1) . ", video IS ";
        $output .= $video->availableInStore() ? "available " : "NOT available ";
        $output .= "for rent\n";
    }
    return $output;
}


// Auto-testing Video Store
$videoStore = new VideoStore();

// Adding 3 videos
$videoStore->addVideo(new Video("The Matrix", 7));
$videoStore->addVideo(new Video("Godfather II", 8));
$videoStore->addVideo(new Video("Star Wars Episode IV: A New Hope", 7));

// Renting out videos
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
echo listInventory($videoStore->getVideoList());


// Manual Testing
$choose = readline("Do You want to manually test Video Store (yes - 'y', no - 'n'): ");
if ($choose !== "y") exit("Bye!\n");

do {
    echo mainMenu();
    $command = (intval(readline("Your selection: ")));
    switch ($command) {
        case 0:
            echo "Come back soon!\n";
            break;
        case 1:
            // Add movies
            echo PHP_EOL;
            $video = readline("Please enter video title: ");
            $rating = intval(readline("Please enter rating (1-10): "));
            $videoStore->addVideo(new Video($video, $rating));
            break;
        case 2:
            // Rent video
            if (count($availableForRent = $videoStore->getAvailableForRent()) < 1) {
                echo "No available videos for rent.\n";
                continue 2;
            };
            echo chooseVideo($availableForRent);
            $rentVideo = intval(readline("Please choose number: "));
            if (array_key_exists(($rentVideo - 1), $availableForRent)) {
                $videoStore->rentVideo($availableForRent[$rentVideo - 1]->getTitle());
            } else {
                echo "Wrong key selected.\n";
            }
            break;
        case 3:
            // Return video
            if (count($availableForReturn = $videoStore->getRentedOut()) < 1) {
                echo "No videos to return.\n";
                continue 2;
            };
            echo chooseVideo($availableForReturn);
            $returnVideo = intval(readline("Please choose number: "));
            if (array_key_exists(($returnVideo - 1), $availableForReturn)) {
                $returnRating = intval(readline("Please rate video (1-10): "));
                $videoStore->returnVideoToStore($availableForReturn[$returnVideo - 1]->getTitle(), $returnRating);
            } else {
                echo "Wrong key selected.\n";
            }
            break;
        case 4:
            // List inventory
            echo listInventory($videoStore->getVideoList());
            break;
        default:
            echo "I don't understand You...";
    }
} while ($command !== 0);