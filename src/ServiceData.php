<?php

namespace HubtelUssdFramework;

class ServiceData {

    public $destination;

    public $amount;

    public $selectedData;

    public function __construct($destination, $amount, $selectedData)
    {
        $this->destination = $destination;
        $this->amount = $amount;
        $this->selectedData = $selectedData;
    }
}