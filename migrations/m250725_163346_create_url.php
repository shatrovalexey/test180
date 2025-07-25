<?php

use yii\db\Migration;

class m250725_163346_create_url extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%url}}', [
            'id' => $this->primaryKey()
            , 'href' => $this->string()->notNull()
            , 'alias' => $this->string()->notNull()->unique()
            , 'created_at' => $this->integer()->notNull()
            , 'updated_at' => $this->integer()->notNull()
            ,
        ]);

        $this->createIndex('idx-alias', '{{%url}}', 'alias');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%url}}');

        return false;
    }
}
