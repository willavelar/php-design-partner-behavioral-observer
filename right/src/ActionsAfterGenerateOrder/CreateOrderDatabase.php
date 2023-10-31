<?php

namespace DesignPattern\Right\ActionsAfterGenerateOrder;

use DesignPattern\Right\Order;

class CreateOrderDatabase implements ActionsAfterGenerateOrder
{
    public function execAction(Order $order): void
    {
        echo "create new order in database" . PHP_EOL;
    }
}