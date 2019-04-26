<?php
/**
 * The followings are the available columns in table 'property':
 * @var integer $id
 * @var string $name
 */
namespace sergmoro1\lookup\models;

use yii\db\ActiveRecord;

class Property extends ActiveRecord
{
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
        return '{{%property}}';
    }

    /**
     * Get property ID by name.
     * @params string property name
     * @return integer property ID
     */
    public static function getId($name) {
        return self::findOne(['name' => $name])->id;
	}

    /**
     * Get all property values as array with Code or Position as index.
     * @params string property name
     * @params string code or position
     * @return array
     */
    public static function getValues($name, $index = 'code') {
		if($property_id = self::getId($name)) {
			$a = [];
			foreach(Lookup::find()
				->select(['position', 'name'])
				->where(['property_id' => $property_id])
				->orderBy($index)->all() as $item)
				$a[$item->$index] = $item->name;
			return $a;
		} else
			return null;
	}
}
