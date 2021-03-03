<?php

class Movie
{
    private string $title;
    private string $studio;
    private string $rating;

    public function __construct(string $title, string $studio, string $rating)
    {
        $this->title = $title;
        $this->studio = $studio;
        $this->rating = $rating;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStudio(): string
    {
        return $this->studio;
    }

    public function getRating(): string
    {
        return $this->rating;
    }

} // END OF CLASS MOVIE

class MovieCollection
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

} // END OF CLASS MOVIE COLLECTION


$movies = new MovieCollection();
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