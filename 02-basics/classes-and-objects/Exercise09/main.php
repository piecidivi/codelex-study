<?php

require_once "BankAccount.php";

$ben = new BankAccount("Benson", -17.5);
echo $ben->showUserNameAndBalance() . PHP_EOL;

$john = new BankAccount("Johnson", 20.3);
echo $john->showUserNameAndBalance() . PHP_EOL;