<?php

use yii\db\Migration;

class m161228_103045_wishlist extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%wishlist}}', [
            'wis_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'pro_id' => $this->integer()->notNull(),
            'date_create' => $this->integer(),
            'status' => $this->boolean(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%wishlist}}');
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
