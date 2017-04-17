<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170409_175336_create_post_table extends Migration
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

        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'anons' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'category_id' => $this->integer(),
            'author_id' => $this->integer()->notNull(),
            //'publish_status' => "enum('" . Post::STATUS_DRAFT . "','" . Post::STATUS_PUBLISH . "') NOT NULL DEFAULT '" . Post::STATUS_DRAFT . "'",
            'publish_activity' => $this->integer()->notNull()->defaultValue(0),
            'publish_date' => $this->timestamp()->notNull(),
        ], $tableOptions);

        $this->createIndex('FK_post_author', '{{%post}}', 'author_id');
        $this->addForeignKey(
            'FK_post_author', '{{%post}}', 'author_id', '{{%user}}', 'id', 'RESTRICT', 'CASCADE'
        );

        $this->createIndex('FK_post_category', '{{%post}}', 'category_id');
        $this->addForeignKey(
            'FK_post_category', '{{%post}}', 'category_id', '{{%category}}', 'id', 'RESTRICT', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%post}}');
    }
}
