<?php
namespace core\forms;

use core\entities\Phone;
use yii\base\Model;

class PhoneForm extends Model
{
    public $number;

    public function __construct($phone = null,$config = [])
    {
        if($phone){
            $this->number = $phone['number'];
        }
        parent::__construct($config);
    }

    public function rules(){
        return [
            //['number', 'each', 'rule' => ['safe']],
            [['number'], 'safe'],
            //[['number'], 'each', 'rule' => ['in', 'range' => ['yes', 'no']]]
        ];
    }

}