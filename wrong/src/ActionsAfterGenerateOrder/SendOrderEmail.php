<?php

namespace DesignPattern\Wrong\ActionsAfterGenerateOrder;

use DesignPattern\Wrong\Order;

class SendOrderEmail
{
    public function __construct(Order $order)
    {
        echo "send email to customer" . PHP_EOL;
    }
}