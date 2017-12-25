<?php

use yii\db\Migration;

class m161212_074327_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'cat_id' => $this->primaryKey(),
            'sid' => $this->integer()->null(),
            'parent_id' => $this->integer()->notNull(),
            'cat_name' => $this->string(100)->notNull(),
            'cat_icon' => $this->string(100)->null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'is_adult' => $this->boolean()->notNull()->defaultValue(0),
            'photo' => $this->string(100)->null(),
            'full_slug' => $this->string()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
