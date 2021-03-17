<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phones}}`.
 */
class m210316_193112_create_phones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%phones}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'number' => $this->string()->notNull()
        ],$tableOptions);

        $this->addForeignKey(
            '{{%fk-book_phones-book_id}}',
            '{{%phones}}',
            'book_id',
            '{{%phones_book}}',
            'id', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%phones}}');
    }
}
