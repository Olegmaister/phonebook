<?php
namespace core\forms;

use core\entities\Phone;
use core\entities\PhoneBook;
use core\validators\PhoneValidator;
use yii\base\Model;
use yii\helpers\ArrayHelper;



class PhoneBookForm extends Model
{
    const REQUIRED_AGE = 18;

    public $firstName;
    public $lastName;
    public $email;
    public $dateBirth;

    public $phones;


    public function __construct(PhoneBook $phoneBook = null,$config = [])
    {

        if($phoneBook){
            $this->firstName = $phoneBook->first_name;
            $this->lastName = $phoneBook->last_name;
            $this->email = $phoneBook->email;
            $this->dateBirth = $phoneBook->date_birth;
            $this->phones = implode(',',$this->listPhone($phoneBook->id));
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['firstName', 'dateBirth','phones'], 'required'],
            ['dateBirth', 'ageCheck'],
            ['phones', 'each', 'rule' => [PhoneValidator::class]],
            [['dateBirth'], 'date', 'format' => 'yyyy-MM-dd'],
            [['firstName', 'lastName'], 'string', 'max' => 32],
            [['email', 'dateBirth'], 'string', 'max' => 100]
        ];
    }

    public function ageCheck($attribute, $params) {

        $year = date("Y",strtotime($this->dateBirth));
        $currentYear = \date('Y',time());

        if(($currentYear-$year) < self::REQUIRED_AGE)
        {
            $this->addError($attribute, 'Необходимый возраст '.self::REQUIRED_AGE);
        }

    }

    private function listPhone($id)
    {
       return ArrayHelper::map(Phone::find()->where(['book_id' => $id])->asArray()->all(),'id','number');
    }

    public function getArray()
    {
        return explode(',',$this->phones);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'Имя',
            'lastName' => 'Фамилия',
            'email' => 'E-mail',
            'dateBirth' => 'Дата рождения'
        ];
    }

    public function beforeValidate()
    {
        $this->phones = explode(',',$this->phones);

        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        $this->phones = implode(',',$this->phones);
        parent::afterValidate();
    }

    protected function internalForms(): array
    {
        return ['phones'];
    }
}