<?php

namespace DesignPattern\Right\ActionsAfterGenerateOrder;

use DesignPattern\Right\Order;

class GenerateOrderLog implements ActionsAfterGenerateOrder
{
    public function execAction(Order $order): void
    {
        echo "generate order creation log" . PHP_EOL;
    }
}