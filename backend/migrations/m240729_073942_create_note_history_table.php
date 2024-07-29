<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%note_history}}`.
 */
class m240729_073942_create_note_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%note_history}}', [
            'id' => $this->primaryKey(),
            'note_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'changed_at' => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_note_history_note_id',
            '{{%note_history}}',
            'note_id',
            '{{%note}}',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_note_history_note_id', '{{%note_history}}');
        $this->dropTable('{{%note_history}}');
    }
}
