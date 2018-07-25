<?php

namespace app\validation\rules;
use Respect\Validation\Exceptions\ValidationException;

class PhoneAvailableException extends ValidationException{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Phone has been used',
        ],
    ];
}