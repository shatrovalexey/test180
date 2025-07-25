<?php

use yii\db\Migration;

class m250725_163920_create_url_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%url_log}}', [
            'id' => $this->primaryKey(),
            'url_id' => $this->integer()->notNull(),
            'ip' => $this->string(17)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-url_log_url', '{{%url_log}}', 'url_id', '{{%url}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%url_log}}');

        return false;
    }
}
