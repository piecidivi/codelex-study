<?php

require_once "Movie.php";

class MoviesCollection
{
    private array $movies = [];

    public function getPG(): array
    {
        return array_filter($this->movies, function (Movie $movie): bool {
            return $movie->getRating() === "PG";
        });
    }

    public function addMovies(array $movies): void
    {
        foreach ($movies as $movie) {
            $this->add($movie);
        }

    }

    private function add(Movie $movie): void
    {
        $this->movies[] = $movie;
    }

}