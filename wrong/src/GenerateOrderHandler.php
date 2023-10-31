<?php

namespace DesignPattern\Wrong;

use DesignPattern\Wrong\ActionsAfterGenerateOrder\CreateOrderDatabase;
use DesignPattern\Wrong\ActionsAfterGenerateOrder\GenerateOrderLog;
use DesignPattern\Wrong\ActionsAfterGenerateOrder\SendOrderEmail;

class GenerateOrderHandler
{
    public function execute(GenerateOrder $generateOrder)
    {
        $budget =  new Budget();

        $budget->items = $generateOrder->getItems();
        $budget->value = $generateOrder->getBudgetValue();

        $order = new Order();
        $order->finalizationDate = new \DateTimeImmutable();
        $order->customerName = $generateOrder->getCustomereName();
        $order->budget = $budget;

        new CreateOrderDatabase($order);
        new GenerateOrderLog($order);
        new SendOrderEmail($order);
    }
}