<?php

namespace DesignPattern\Wrong\ActionsAfterGenerateOrder;

use DesignPattern\Wrong\Order;

class CreateOrderDatabase
{
    public function __construct(Order $order)
    {
        echo "create new order in database" . PHP_EOL;
    }
}