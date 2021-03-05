<?php

require_once "Account.php";

// Your first account
$myAccount = new Account("myAccount", 100.00);
$myAccount->deposit(20.00);

echo "Your first account\n";
echo "'{$myAccount->getName()}' balance is " . number_format($myAccount->getBalance(), 2) . "\n\n";


// Your first money transfer
$mattsAccount = new Account("Matt's account", 1000);
$myAccount = new Account("My account", 0);
$mattsAccount->withdraw(100.0);
$myAccount->deposit(100.0);

echo "Your first money transfer\n";
echo "'{$mattsAccount->getName()}' balance is " . number_format($mattsAccount->getBalance(), 2) . "\n";
echo "'{$myAccount->getName()}' balance is " . number_format($myAccount->getBalance(), 2) . "\n\n";


// Money transfers
$a = new Account("A", 100.0);
$b = new Account("B", 0.0);
$c = new Account("C", 0.0);
Account::transfer($a, $b, 50.0);
Account::transfer($b, $c, 25.0);

echo "Money transfers\n";
echo "'{$a->getName()}' balance is " . number_format($a->getBalance(), 2) . "\n";
echo "'{$b->getName()}' balance is " . number_format($b->getBalance(), 2) . "\n";
echo "'{$c->getName()}' balance is " . number_format($c->getBalance(), 2) . "\n\n";