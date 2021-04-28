<?php

namespace App\Validation;

use InvalidArgumentException;

class InputValidator
{
    public function validate(array $request, array $required, array $rules): void
    {
        $this->required($request, $required);
        $this->applyRules($request, $rules);
    }

    private function required(array $request, array $required): void
    {
        foreach ($required as $requirement) {
            if (!array_key_exists($requirement, $request) && empty($request[$requirement])) {
                throw new InvalidArgumentException("Please fill all required fields.");
            }
        }
    }

    private function applyRules(array $request, array $rules): void
    {
        foreach ($request as $key => $value) {
            foreach ($rules as $ruleKey => $ruleSet) {
                if ($key === $ruleKey) {
                    foreach ($ruleSet as $ruleSetKey => $constraints) {
                        if (method_exists($this, $ruleSetKey)) {
                            call_user_func_array([$this, $ruleSetKey], [$value, $constraints]);
                        }
                    }
                }
            }
        }
    }


    private function email(string $sample): void
    {
        if (!filter_var($sample, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Incorrect email address provided.");
        }
    }

    private function password(string $sample): void
    {
        if (!ctype_alnum($sample)) {
            throw new InvalidArgumentException("Password must contain letters and numbers only!");
        }
    }

    private function length(string $sample, array $constraints): void
    {
        if (strlen($sample) < $constraints["min"] || strlen($sample) > $constraints["max"]) {
            throw new InvalidArgumentException("Password length must be 8-20 characters.");
        }
    }

    private function name(string $sample, array $constraints): void
    {
        if (!preg_match('/^[\p{L} ]+$/u', $sample)) {
            throw new InvalidArgumentException("Name must contain letters and spaces only!");
        }
    }

    private function key(string $sample, array $constraints): void
    {
        if (!in_array($sample, $constraints)) {
            throw new InvalidArgumentException("Please do not tamper with system data!");
        }
    }

    private function match(string $sample, array $constraints): void
    {
        if ($sample !== $constraints["password"]) {
            throw new InvalidArgumentException("Passwords must match!");
        }
    }

}