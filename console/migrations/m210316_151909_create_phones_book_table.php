<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phones_book}}`.
 */
class m210316_151909_create_phones_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%phones_book}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(32)->notNull(),
            'last_name' => $this->string(32)->null(),
            'email' => $this->string(100)->null(),
            'date_birth' => $this->date()->notNull(),
            'phone' => $this->string(50)
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%phones_book}}');
    }
}
