<?php

use yii\db\Migration;

/**
 * Class m180704_105455_create_property
 */
class m160206_155455_create_property extends Migration
{
    const TABLE = '{{%property}}';
    
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

		$this->addCommentOnColumn(self::TABLE, 'name', 'Property name');
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}
