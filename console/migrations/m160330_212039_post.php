<?php

use yii\db\Migration;

class m160330_212039_post extends Migration
{
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(128)->notNull()->unique(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('post_lang', [
            'post_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(2)->notNull(),
            'title' => $this->string(128)->notNull(),
            'description' => $this->text()->notNull(),
            'PRIMARY KEY ("post_id", "lang_id")'
        ]);
    }

    public function down()
    {
        $this->dropTable('post_lang');
        $this->dropTable('post');
    }
}
