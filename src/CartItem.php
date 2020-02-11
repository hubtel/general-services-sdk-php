<?php

namespace HubtelUssdFramework;

class CartItem {

    public $itemName;

    public $qty;

    public $price;

    public function __construct($itemName, $qty, $price)
    {
        $this->itemName = $itemName;
        $this->qty = $qty;
        $this->price = $price;
    }
}