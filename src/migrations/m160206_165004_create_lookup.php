<?php

use yii\db\Migration;

class m160206_165004_create_lookup extends Migration
{
    const TABLE = '{{%lookup}}';
    
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE, [
            'id'          => $this->primaryKey(),
            'name'        => $this->string()->notNull(),
            'property_id' => $this->integer()->notNull(),
            'code'        => $this->integer()->notNull(),
            'position'    => $this->integer()->notNull(),
        ], $tableOptions);
        
        $this->createIndex('idx-property',      self::TABLE, 'property_id');
        $this->createIndex('idx-property-code', self::TABLE, ['property_id', 'code'], true);

        $this->addForeignKey ('fk-lookup-property', self::TABLE, 'property_id', '{{%property}}', 'id', 'restrict', 'restrict');

		$this->addCommentOnColumn(self::TABLE, 'name',        'Property value name');
		$this->addCommentOnColumn(self::TABLE, 'property_id', 'Property');
		$this->addCommentOnColumn(self::TABLE, 'code',        'Value code');
		$this->addCommentOnColumn(self::TABLE, 'position',    'Position of value in a list');
    }

    public function safeDown()
    {
        $this->dropForeignKey ('fk-lookup-property', self::TABLE);
        $this->dropTable(self::TABLE);
    }
}
