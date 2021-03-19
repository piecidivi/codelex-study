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
    <link rel="shortcut icon" href="public/favicon.ico">
  </head>
  <body>
    <h1>Auto īres super lapa</h1>
    <form action="" method="post">
      <table>
        <caption>Auto īre</caption>
        <thead>
          <tr>
            <th>Marka</th>
            <th>Modelis</th>
            <th>Patēriņš uz 100km</th>
            <th>Īres cena</th>
            <th>Statuss</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($collection->cars() as $car) /** @var Car $car */ { ?>
            <tr>
              <td><?php echo $car->make(); ?></td>
              <td><?php echo $car->model(); ?></td>
              <td><?php echo number_format($car->consumption() / 10, 1); ?></td>
              <td><?php echo number_format($car->price() / 100, 2); ?></td>
              <?php if ($car->getStatus() === "available") { ?>
                <td>
                  <button type="submit" name="status" value="<?php echo $car->id() . "/rented"; ?>">Īrēt</button>
                </td>
              <?php } else { ?>
                <td>
                  <button type="submit" name="status" value="<?php echo $car->id() . "/available"; ?>">Atdot</button>
                </td>
              <?php } ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
  </body>
</html>