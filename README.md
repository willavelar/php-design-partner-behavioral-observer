## Command

Observer is a behavioral design pattern that lets you define a subscription mechanism to notify multiple objects about any events that happen to the object they’re observing.

-----

When an order is generated, we need to perform several actions such as storing it in the database, sending it by email, and generating a log.

### The problem

If we need to add more actions after generating order, our function will grow infinitely.

```php
<?php
class Order
{
    public string $customerName;
    public \DateTimeInterface $finalizationDate;
    public Budget $budget;
}
```
```php
<?php
class Budget 
{
    public float $value;
    public int $items;
}
```

```php
<?php
class GenerateOrder
{
    private float $budgetValue;
    private int $items;
    private string $customereName;

    public function __construct(float $budgetValue, int $items, string $customereName)
    {
        $this->budgetValue = $budgetValue;
        $this->items = $items;
        $this->customereName = $customereName;
    }

    public function getBudgetValue(): float
    {
        return $this->budgetValue;
    }

    public function getItems(): int
    {
        return $this->items;
    }

    public function getCustomereName(): string
    {
        return $this->customereName;
    }

}
```

```php
<?php
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
```
```php
<?php
class CreateOrderDatabase
{
    public function __construct(Order $order)
    {
        echo "create new order in database" . PHP_EOL;
    }
}
```
```php
class GenerateOrderLog
{
    public function __construct(Order $order)
    {
        echo "generate order creation log" . PHP_EOL;
    }
}
```
```php
<?php
class SendOrderEmail
{
    public function __construct(Order $order)
    {
        echo "send email to customer" . PHP_EOL;
    }
}
```
### The solution

Now, using the Observer design patern, we can step outside the class as many actions as we want, without changing it.
```php
<?php
interface ActionsAfterGenerateOrder
{
    public function execAction(Order $order) : void;
}
```
```php
<?php
class CreateOrderDatabase implements ActionsAfterGenerateOrder
{
    public function execAction(Order $order): void
    {
        echo "create new order in database" . PHP_EOL;
    }
}
```
```php
<?php
class GenerateOrderLog implements ActionsAfterGenerateOrder
{
    public function execAction(Order $order): void
    {
        echo "generate order creation log" . PHP_EOL;
    }
}
```
```php
<?php
class SendOrderEmail implements ActionsAfterGenerateOrder
{
    public function execAction(Order $order): void
    {
        echo "send email to customer" . PHP_EOL;
    }
}
```
```php
<?php
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
```
-----

### Installation for test

![PHP Version Support](https://img.shields.io/badge/php-7.4%2B-brightgreen.svg?style=flat-square) ![Composer Version Support](https://img.shields.io/badge/composer-2.2.9%2B-brightgreen.svg?style=flat-square)

```bash
composer install
```

```bash
php wrong/test.php {budgetValue} {items} {customereName}
php right/test.php {budgetValue} {items} {customereName}
```