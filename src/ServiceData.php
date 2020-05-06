<?php

namespace HubtelUssdFramework;

class ServiceData
{

    public $Destination;

    public $Amount;

    public $bundle;

    public function __construct($Destination, $Amount, $bundle)
    {
        $this->Destination = $Destination;
        $this->Amount = $Amount;
        $this->bundle = $bundle;
    }
}
