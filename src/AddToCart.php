<?php

namespace HubtelUssdFramework;

class AddToCart {

    public $amount;
    public $itemId;
    public $description;



    public function __construct($amount, $itemId, $description)
    {
        $this->amount = $amount;
        $this->itemId = $itemId;
        $this->description = $description;
    }
}
