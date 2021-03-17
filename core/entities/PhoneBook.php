<?php

namespace core\entities;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%phones_book}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string $date_birth
 * @property string|null $phone
 *
 *  * @property Phone[] $phones
 */
class PhoneBook extends ActiveRecord
{

    public static function create(string $firstName, string $lastName, string $email, string $dateBirth) : self
    {
        $phoneBook = new self();
        $phoneBook->first_name =  $firstName;
        $phoneBook->last_name = $lastName;
        $phoneBook->email = $email;
        $phoneBook->date_birth = $dateBirth;

        return $phoneBook;
    }

    public function edit(string $firstName, string $lastName, string $email, string $dateBirth)
    {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->date_birth = $dateBirth;
    }

    public function assignPhone($number)
    {
        $phones = $this->phones;
        $phone = Phone::create($number);
        $phones[] = $phone;
        $this->phones = $phones;
    }

    public function getListPhones()
    {
        $phones = [];
        foreach ($this->phones as $phone) {
            $phones[] = $phone->number;
        }
        return implode(',',$phones);
    }

    public function revokePhones()
    {
        $this->phones = [];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%phones_book}}';
    }


    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['phones'],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'date_birth' => 'Date Birth',
            'phone' => 'Phone',
        ];
    }

    /**
     * Gets query for [[Phones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::class, ['book_id' => 'id']);
    }
}
