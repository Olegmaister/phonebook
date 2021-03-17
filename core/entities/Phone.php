<?php

namespace core\entities;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%phones}}".
 *
 * @property int $id
 * @property int $book_id
 * @property string $number
 *
 * @property PhoneBook $book
 */
class Phone extends ActiveRecord
{
    public static function create($number)
    {
        $phone = new self();
        $phone->number = $number;

        return $phone;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%phones}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'number' => 'Number',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(PhoneBook::class, ['id' => 'book_id']);
    }
}
