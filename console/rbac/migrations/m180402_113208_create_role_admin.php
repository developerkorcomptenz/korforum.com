<?php

use yii2mod\rbac\migrations\Migration;

class m180402_113208_create_role_admin extends Migration
{
        public function safeUp()
    {
        $this->createRole('admin', 'admin has all available permissions.');
    }

    public function safeDown()
    {
        $this->removeRole('admin');
    }
}