<?php 

namespace HubtelUssdFramework;

class DataItem {
    public $display;
    public $value;
    public $amount;

    public function __construct($display, $value, $amount)
    {
        $this->display = $display;
        $this->value = $value;
        $this->amount = $amount;
    }
}