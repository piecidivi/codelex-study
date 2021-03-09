<?php

// We will have our Flower Shop here
// Shop.php is Flower Shop
// SillyTrade.php, RegularTrade.php, and HustleTrade.php are wholesalers
// They all extend abstract Warehouse class
// Wholesalers implement Trade interface
// Flower object itself is described by Flower class
// Warehouse class has array property as Flowers collection
// View class is formatting output

require_once "Flower.php";
require_once "Warehouse.php";
require_once "Shop.php";
require_once "SillyTrade.php";
require_once "RegularTrade.php";
require_once "HustleTrade.php";
require_once "Trade.php";
require_once "View.php";