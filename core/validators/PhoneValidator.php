<?php

namespace core\validators;

use yii\validators\RegularExpressionValidator;

class PhoneValidator extends RegularExpressionValidator
{
    public $pattern = "#^(\+38){0,1}0\d{3}\d{2}\d{2}\d{2}$#";
    public $message = 'valid format +380671121083 or 0671121083';
}

