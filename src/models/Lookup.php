<?php
namespace sergmoro1\lookup\models;

use yii\db\ActiveRecord;

class Lookup extends ActiveRecord
{
    /**
     * The followings are the available columns in table 'tbl_lookup':
     * @var integer $id
     * @var string $name
     * @var integer $code
     * @var integer $property_id
     * @var integer $position
     */

    private static $_items = [];

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%lookup}}';
    }

    /**
     * Returns the items for the specified type.
     * @param string | integer property name or ID
     * @return array item names indexed by item code. The items are order by their position values.
     * @param boolean slug or integer ID
     * An empty array is returned if the item type does not exist.
     */
    public static function items($property, $byId = false)
    {
        $property_id = self::getPropertyId($property, $byId);
        if(!isset(self::$_items[$property_id]))
            self::loadItems($property_id);
        return self::$_items[$property_id];
    }

    /**
     * Returns the item name for the specified property and code.
     * @param string | integer property name or ID
     * @param integer the item code (corresponding to the 'code' column value)
     * @param boolean slug or integer ID
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($property, $code, $byId = false)
    {
        $property_id = self::getPropertyId($property, $byId);
        if(!isset(self::$_items[$property_id]))
            self::loadItems($property_id);
        return isset(self::$_items[$property_id][$code]) ? self::$_items[$property_id][$code] : false;
    }

    private static function getPropertyId($property, $byId) {
        return $byId ? $property : Property::getId($property);
    }

    /**
     * Loads the lookup items for the specified property ID.
     * @param string the item type
     */
    private static function loadItems($property_id)
    {
        self::$_items[$property_id] = [];
        $models = static::find()
            ->where('property_id=:property_id', [':property_id' => $property_id])
            ->orderBy('position')
            ->all();
        foreach($models as $model)
            self::$_items[$property_id][$model->code] = $model->name;
    }
    
    public function getProperty() {
        return Property::findOne($this->property_id);
    }
}
