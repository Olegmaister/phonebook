<?php

namespace core\validators;

use yii\validators\RegularExpressionValidator;

class PhoneValidator extends RegularExpressionValidator
{
    public $pattern = '#^\+380{0,1}\d{3}\d{2}\d{2}\d{2}$#';
    public $message = 'Допустимый формат +380671121083';
}

