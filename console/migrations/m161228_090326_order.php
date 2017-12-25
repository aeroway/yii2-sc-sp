<?php

use yii\db\Migration;

class m161228_090326_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order}}', [
            'order_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'user_name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'mobile' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'user_ship' => $this->string()->notNull(),
            'email_ship' => $this->string()->notNull(),
            'mobile_ship' => $this->string()->notNull(),
            'address_ship' => $this->string()->notNull(),
            'request' => $this->text(),
            'total' => $this->integer(),
            'payment_id' => $this->integer(),
            'deliver_id' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%order}}');
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
