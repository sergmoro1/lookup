<?php

use yii\db\Migration;

use sergmoro1\lookup\models\Lookup;
use sergmoro1\lookup\models\Property;

/**
 * Class m180709_092055_update_lookup
 */
class m180709_092055_update_lookup extends Migration
{
    private const TABLE_LOOKUP   = '{{%lookup}}';
    private const TABLE_PROPERTY = '{{%property}}';

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn(static::TABLE_LOOKUP, 'property_id', $this->integer());
        $property = null;
        foreach(Lookup::find()->all() as $item) {
            if(!($property && $property->name == $item->type)) {
                if(!($property = Property::findOne(['name' => $item->type]))) {
                    $property = new Property([
                        'name' => $item->type,
                    ]);
                    $property->save();
                }
            }
            $item->property_id = $property->id;
            $item->save();
        }
        $this->createIndex('idx-property-code', static::TABLE_LOOKUP, ['property_id', 'code']);
        $this->addForeignKey ('fk-lookup-property', static::TABLE_LOOKUP, 'property_id', static::TABLE_PROPERTY, 'id', 'CASCADE');
        $this->dropColumn(static::TABLE_LOOKUP, 'type');
    }

    public function down()
    {
        $this->addColumn(static::TABLE_LOOKUP, 'type', $this->string(128));
        foreach(Lookup::find()->all() as $item) {
            $item->type = $item->property->name;
            $item->save();
        }
        $this->dropIndex('idx-property-code', static::TABLE_LOOKUP);
        $this->dropIndex('fk-lookup-property', static::TABLE_LOOKUP);
        $this->dropColumn(static::TABLE_LOOKUP, 'property_id');
    }
}
