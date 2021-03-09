<?php


class Application
{
    // Initialize wholesalers
    public function initSilly(): object {
        $silly = new SillyWarehouse("Silly Warehouse");
        $silly->addFlowers([
            new Flower("rose", 100),
            new Flower("tulip", 50),
            new Flower("carnation", 50),
            new Flower("dahlia", 50)
        ]);
        return $silly;
    }

    public function initRegular(): object {
        $regular = new RegularWarehouse("Regular Warehouse");
        $regular->addFlowers([
            new Flower("gerber", 94),
            new Flower("daisy", 56),
            new Flower("narcissus", 75),
            new Flower("aster", 280)
        ]);
        return $regular;
    }

    public function initHustler(): object {
        $hustler = new HustleWarehouse("Hustler Warehouse");
        $hustler->addFlowers([
            new Flower("rose", 77),
            new Flower("dahlia", 152),
            new Flower("gerber", 145),
            new Flower("daisy", 188)
        ]);
        return $hustler;
    }


    // Money is multiplied by 100 already here (before accessing other objects)
    public function initShop(): object {
        $shop = new Shop("Flowers Round The Corner - F.R.T.C.", 100000);
        $shop->addFlowers([
            new Flower("rose", 0, 500),
            new Flower("tulip", 0, 300),
            new Flower("gerber", 0, 400),
            new Flower("carnation", 0, 550),
            new Flower("daisy", 0, 250),
            new Flower("narcissus", 0, 350),
            new Flower("aster", 0, 275),
            new Flower("dahlia", 0, 335)
        ]);
        return $shop;
    }


}