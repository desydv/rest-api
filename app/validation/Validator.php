<?php

namespace app\validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator{
    protected $errors;
    
    public function validate($request, array $rules){
        foreach ($rules as $field => $rule){
            try{
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            }catch (NestedValidationException $e) {
                $errors[$field] = $e->getMessages();
            }
        }
        return $errors;
    }
}