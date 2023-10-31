<?php

use DesignPattern\Right\{ActionsAfterGenerateOrder\CreateOrderDatabase, ActionsAfterGenerateOrder\GenerateOrderLog, ActionsAfterGenerateOrder\SendOrderEmail,
    GenerateOrder, GenerateOrderHandler};

require "vendor/autoload.php";

$budgetValue = $argv[1];
$items = $argv[2];
$customereName = $argv[3];

$generateOrder = new GenerateOrder($budgetValue, $items, $customereName);
$gerarPedidoHandler = new GenerateOrderHandler();
$gerarPedidoHandler->addActionsAfterGenerateOrder(new CreateOrderDatabase());
$gerarPedidoHandler->addActionsAfterGenerateOrder(new GenerateOrderLog());
$gerarPedidoHandler->addActionsAfterGenerateOrder(new SendOrderEmail());
$gerarPedidoHandler->execute($generateOrder);