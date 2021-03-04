<?php

require_once "Movie.php";
require_once "MoviesCollection.php";

$movies = new MoviesCollection();
$movies->addMovies([
    new Movie("Casino Royal", "Eon Productions", "PG13"),
    new Movie("Glass", "Buena Vista International", "PG13"),
    new Movie("Spider-Man: Into the Spider-Verse", "Columbia Pictures", "PG"),
]);

foreach ($movies->getPG() as $movie) {
    /** @var Movie $movie */
    echo "Movies that correspond to rating PG:" . PHP_EOL;
    echo "{$movie->getTitle()}, {$movie->getStudio()}, {$movie->getRating()}." . PHP_EOL;
}