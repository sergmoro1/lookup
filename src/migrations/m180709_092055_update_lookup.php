<?php

use yii\db\Migration;

use sergmoro1\lookup\models\Lookup;
use sergmoro1\lookup\models\Property;

/**
 * Class m180709_092055_update_lookup
 */
class m180709_092055_update_lookup extends Migration
{
    const TABLE = '{{%lookup}}';

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn(self::TABLE, 'property_id', $this->integer());
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
        $this->createIndex('property_code', self::TABLE, ['property_id', 'code']);
        $this->addForeignKey ('FK_lookup_property', self::TABLE, 'property_id', '{{%property}}', 'id', 'CASCADE');
        $this->dropColumn(self::TABLE, 'type');
    }

    public function down()
    {
        $this->addColumn(self::TABLE, 'type', $this->string(128));
        foreach(Lookup::find()->all() as $item) {
            $item->type = $item->property->name;
            $item->save();
        }
        $this->dropIndex('property_code', self::TABLE);
        $this->dropIndex('FK_lookup_property', self::TABLE);
        $this->dropColumn(self::TABLE, 'property_id');
    }
}
