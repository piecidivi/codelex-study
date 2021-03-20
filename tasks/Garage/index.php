<?php

use App\CarCollection;
use App\Car;

require_once "vendor/autoload.php";

$collection = new CarCollection();
if ($_POST["status"]) {
  $collection->changeStatus($_POST["status"]);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Auto īre</title>
    <link rel="stylesheet" href="<?php echo "public/styles.css" ?>">
    <link rel="shortcut icon" type="image/png" href="public/favicon.ico">
  </head>
  <body>
    <form action="" method="post">
      <table>
        <col style="width:20%">
        <col style="width:40%">
        <col style="width:25%">
        <col style="width:15%">
        <tbody>
          <?php foreach ($collection->cars() as $car) /** @var Car $car */ { ?>
            <tr>
              <td rowspan="4"><img src="<?php echo $car::CAR_PICTURE_PATH . $car->picture(); ?>"
                                   alt="Picture of <?php echo "{$car->make()} {$car->model()}"; ?>"></td>
              <td class="info info-title">Auto modelis&nbsp;&nbsp;&nbsp;</td>
              <td class="info info-data"><?php echo "{$car->make()} {$car->model()}"; ?></td>
              <?php if ($car->getStatus() === "available") { ?>
                <td rowspan="4">
                  <button class="button-available" type="submit" name="status"
                          value="<?php echo $car->id() . "/rented"; ?>">ĪRĒT
                  </button>
                </td>
              <?php } else { ?>
                <td rowspan="4">
                  <button class="button-rented" type="submit" name="status"
                          value="<?php echo $car->id() . "/available"; ?>">ATDOT
                  </button>
                </td>
              <?php } ?>
            </tr>
            <tr>
              <td class="info info-title">Degvielas patēriņš uz 100 kilometriem&nbsp;&nbsp;&nbsp;</td>
              <td class="info info-data"><?php echo number_format($car->consumption() / 10, 1); ?></td>
            </tr>
            <tr>
              <td class="info info-title">Īres cena&nbsp;&nbsp;&nbsp;</td>
              <?php if ($car->getStatus() === "available") { ?>
                <td class="info info-data"><?php echo number_format($car->price() / 100, 2); ?></td>
              <?php } else { ?>
                <td class="info info-data info-data-unavailable"><?php echo number_format($car->price() / 100, 2) . " NAV PIEEJAMS"; ?></td>
              <?php } ?>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
  </body>
</html>