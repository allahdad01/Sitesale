<?php

namespace App\Core;

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];

        foreach ($rules as $field => $ruleSet) {
            $ruleList = is_array($ruleSet) ? $ruleSet : explode('|', $ruleSet);
            $value    = $data[$field] ?? null;

            foreach ($ruleList as $rule) {
                $params = [];

                if (str_contains($rule, ':')) {
                    [$rule, $paramStr] = explode(':', $rule, 2);
                    $params = explode(',', $paramStr);
                }

                $methodName = 'rule' . ucfirst($rule);

                if (method_exists($this, $methodName)) {
                    $this->$methodName($field, $value, $params);
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function firstError(): string
    {
        return $this->errors ? $this->errors[array_key_first($this->errors)] : '';
    }

    private function ruleRequired(string $field, mixed $value, array $params): void
    {
        if ($value === null || $value === '' || (is_array($value) && empty($value))) {
            $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    private function ruleEmail(string $field, mixed $value, array $params): void
    {
        if ($value !== null && $value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = 'Please provide a valid email address.';
        }
    }

    private function ruleMin(string $field, mixed $value, array $params): void
    {
        $min = (int) ($params[0] ?? 0);
        if ($value !== null && mb_strlen($value) < $min) {
            $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " must be at least {$min} characters.";
        }
    }

    private function ruleMax(string $field, mixed $value, array $params): void
    {
        $max = (int) ($params[0] ?? 9999);
        if ($value !== null && mb_strlen($value) > $max) {
            $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " must not exceed {$max} characters.";
        }
    }

    private function rulePhone(string $field, mixed $value, array $params): void
    {
        if ($value !== null && $value !== '' && !preg_match('/^[\+\d][\d\s\-\(\)]{6,20}$/', $value)) {
            $this->errors[$field] = 'Please provide a valid phone number.';
        }
    }

    private function ruleDate(string $field, mixed $value, array $params): void
    {
        if ($value !== null && $value !== '') {
            $ts = strtotime($value);
            if ($ts === false) {
                $this->errors[$field] = 'Please provide a valid date.';
            }
        }
    }

    private function ruleNumeric(string $field, mixed $value, array $params): void
    {
        if ($value !== null && $value !== '' && !is_numeric($value)) {
            $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' must be a number.';
        }
    }
}
