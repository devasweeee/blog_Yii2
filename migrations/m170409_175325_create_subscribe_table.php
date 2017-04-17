<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscribe`.
 */
class m170409_175325_create_subscribe_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subscribe}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'sub_id'  => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_subscribe_user', '{{%subscribe}}', 'user_id');
        $this->addForeignKey(
            'FK_subscribe_user', '{{%subscribe}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'
        );

        $this->createIndex('FK_subscribe_sub', '{{%subscribe}}', 'sub_id');
        $this->addForeignKey(
            'FK_subscribe_sub', '{{%subscribe}}', 'sub_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%subscribe}}');
    }
}
