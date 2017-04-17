<?php

use common\models\User;
use yii\db\Migration;

class m170409_175337_default_user extends Migration
{
    public function up()
    {
        $this->insert('{{%user}}', [
            'username' => 'demoadmin',
            'auth_key' => 'Jg6O-7Sho1sxY38OgTcx3RTX30VUlXTi',
            'password_hash' => '$2y$13$MKjLOsF/qyONMpwqhOe99ufFNK.3f8amFf5lB27/4zD9F1Xj4EiVy',
            'email' => 'admin@localhost.local',
            'role' => '100',
            'status' => '10',
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function down()
    {
        $this->delete(User::tableName(), 'username = "demoadmin"');
    }
}
