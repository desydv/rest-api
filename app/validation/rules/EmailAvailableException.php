<?php

namespace app\validation\rules;
use Respect\Validation\Exceptions\ValidationException;

class EmailAvailableException extends ValidationException{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Email has been used',
        ],
    ];
}