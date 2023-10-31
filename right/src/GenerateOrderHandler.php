<?php

namespace DesignPattern\Right;

use DesignPattern\Right\ActionsAfterGenerateOrder\ActionsAfterGenerateOrder;

class GenerateOrderHandler
{
    /** @var ActionsAfterGenerateOrder[]  */
    private array $actionsAfterGenerateOrder = [];

    public function addActionsAfterGenerateOrder(ActionsAfterGenerateOrder $action)
    {
        $this->actionsAfterGenerateOrder[] = $action;
    }
    public function execute(GenerateOrder $generateOrder)
    {
        $budget =  new Budget();

        $budget->items = $generateOrder->getItems();
        $budget->value = $generateOrder->getBudgetValue();

        $order = new Order();
        $order->finalizationDate = new \DateTimeImmutable();
        $order->customerName = $generateOrder->getCustomereName();
        $order->budget = $budget;

        foreach ($this->actionsAfterGenerateOrder as $action) {
            $action->execAction($order);
        }
    }
}