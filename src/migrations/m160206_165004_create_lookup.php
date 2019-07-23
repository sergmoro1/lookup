<?php
namespace sergmoro1\lookup\migrations;

use yii\db\Schema;
use yii\db\Migration;

class m160206_165004_create_lookup extends Migration
{
    private const TABLE_LOOKUP = '{{%lookup}}';
    private const TABLE_PROPERTY = '{{%property}}';
    
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(static::TABLE_LOOKUP, [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(128)->notNull(),
            'property_id' => $this->integer()->notNull(),
            'code'        => $this->integer()->notNull(),
            'position'    => $this->integer()->notNull(),
        ], $tableOptions);
        
        $this->createIndex('idx-property',      static::TABLE_LOOKUP, 'property_id');
        $this->createIndex('idx-property-code', static::TABLE_LOOKUP, ['property_id', 'code']);

        $this->addForeignKey ('fk-lookup-property', static::TABLE_LOOKUP, 'property_id', static::TABLE_PROPERTY, 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable(static::TABLE_LOOKUP);
    }
}
