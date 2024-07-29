<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%note}}`.
 */
class m240729_073404_create_note_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%note}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(1024)->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_note_user_created_by', '{{%note}}', 'created_by', '{{%user}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_note_user_created_by', '{{%note}}');
        $this->dropTable('{{%note}}');
    }
}
