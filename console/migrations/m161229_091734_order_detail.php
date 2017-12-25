<?php

use yii\db\Migration;

class m161229_091734_order_detail extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order_detail}}', [
            'order_detail_id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'pro_id' => $this->integer()->notNull(),
            'pro_price' => $this->integer(),
            'pro_amount' => $this->integer(),
            'status' => $this->boolean(),
            'created_at' => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%order_detail}}');
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
