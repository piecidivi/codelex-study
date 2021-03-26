<?php

use App\Elements\Element;
use App\Elements\ElementCollection;
use App\Elements\Paper;
use App\Elements\Rock;
use App\Elements\Scissors;
use App\Game;
use App\Players\Player;
use App\Players\PlayerCollection;

require_once "vendor/autoload.php";

$elements = new ElementCollection([new Rock, new Paper, new Scissors]);
$human = new Player("H", "You");
$computer = new Player("C", "Computer");
$players = new PlayerCollection([$human, $computer]);
$game = new Game($elements, $players);

if (isset($_POST["option"])) {
  $game->setChoice($_POST["option"]);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RPS</title>
    <link rel="stylesheet" href="<?php echo "public/styles.css" ?>">
    <link rel="shortcut icon" type="image/png" href="public/favicon.ico">
  </head>
  <body>
    <p>Select Your Weapon</p>
    <section id="section_forms">
      <?php foreach ($elements->elements() as $element) {
        /** @var Element $element */ ?>
        <form action="" method="post">
          <input type="text" name="option" value="<?php echo $element->name(); ?>" hidden>
          <input type="image" class="input-image" src="<?php echo $element->picture(); ?>" alt="Submit">
        </form>
      <?php } ?>
    </section>
    <section>
      <p class="regular"><?php echo "{$human->choice()} vs "; ?>
        <?php echo "{$computer->choice()}"; ?></p>
      <p class="<?php echo explode(" ", $game->gameResult($human, $computer))[0]; ?>">
        <?php echo $game->gameResult($human, $computer); ?></p>
    </section>
  </body>
</html>