<?php

require_once "vendor/autoload.php";

use App\Shop;
use App\Suppliers\AmazingGardenSupplier;
use App\Suppliers\CoolGardenSupplier;
use App\Suppliers\HeheSupplier;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$shop = new Shop();
$shop->addSupplier(new AmazingGardenSupplier);
$shop->addSupplier(new CoolGardenSupplier);
$shop->addSupplier(new HeheSupplier);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flower Shop</title>
    <link href="<?php echo "public/styles.css" ?>" rel="stylesheet">
</head>
<body>
<div>
    <table>
        <caption>Flower Shop</caption>
        <thead>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Price</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($shop->products()->all() as ['product' => $product, 'amount' => $amount]) { ?>
            <tr>
                <td><?php echo $product->sellable()->id(); ?></td>
                <td><?php echo $product->sellable()->name(); ?></td>
                <td><?php echo $product->price(); ?></td>
                <td><?php echo $amount; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>