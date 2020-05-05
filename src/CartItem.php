<?php

namespace HubtelUssdFramework;

class CartItem
{

    public $itemName;

    public $qty;

    public $price;

    public $serviceData;

    public function __construct($itemName, $qty, $price, $serviceData = null)
    {
        $this->itemName = $itemName;
        $this->qty = $qty;
        $this->price = $price;
        $this->serviceData = $serviceData;
    }
}
