<?php

namespace App\Controllers;

abstract class Controller
{
    protected string $formLayout;
    protected string $tableLayout;
    protected string $postName;
    protected string $pageName;
    protected string $tableMessage;
    protected string $formMessage;
    protected string $loginMessage;

    const FORM_LAYOUT_GET = "get";
    const FORM_LAYOUT_POST = "post";
    const TABLE_LAYOUT_INIT = "init";
    const TABLE_LAYOUT_DATA = "data";

    protected function validatePersonalCode(string $personalCode): bool
    {
        return preg_match("/^[0-9-]{11,12}$/", $personalCode);
    }

    protected function validateName(string $name): bool
    {
        return strlen($name) > 0 && preg_match('/^[\p{L}\-\s]+$/u', $name);
    }

    protected function validateAge(string $age): bool
    {
        return preg_match("/^[0-9]{1,3}$/", $age);
    }

    protected function validateAddress(string $address): bool
    {
        return strlen($address) > 0 && preg_match('/^[\",.\d\p{L}\-\s]+$/u', $address);
    }
}