<?php

namespace DesignPattern\Right\ActionsAfterGenerateOrder;

use DesignPattern\Right\Order;

class SendOrderEmail implements ActionsAfterGenerateOrder
{
    public function execAction(Order $order): void
    {
        echo "send email to customer" . PHP_EOL;
    }
}