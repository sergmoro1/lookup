<?php
namespace sergmoro1\lookup\models;

use Yii;
use yii\db\ActiveRecord;

class Lookup extends ActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_lookup':
	 * @var integer $id
	 * @var string $name
	 * @var integer $code
	 * @var string $type
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
	 * @param string item type (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	 */
	public static function items($type)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}

	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($type, $code)
	{
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems($type)
	{
		self::$_items[$type] = [];
		$models = static::find()
			->where('type=:type', [':type' => $type])
			->orderBy('position')
			->all();
		foreach($models as $model)
			self::$_items[$type][$model->code] = $model->name;
	}
}
