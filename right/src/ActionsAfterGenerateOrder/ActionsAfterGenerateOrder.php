<?php

namespace DesignPattern\Right\ActionsAfterGenerateOrder;

use DesignPattern\Right\Order;

interface ActionsAfterGenerateOrder
{
    public function execAction(Order $order) : void;
}