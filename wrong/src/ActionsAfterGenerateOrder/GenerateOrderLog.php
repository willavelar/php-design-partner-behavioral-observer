<?php

namespace DesignPattern\Wrong\ActionsAfterGenerateOrder;

use DesignPattern\Wrong\Order;

class GenerateOrderLog
{
    public function __construct(Order $order)
    {
        echo "generate order creation log" . PHP_EOL;
    }
}