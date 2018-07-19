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
     * Get ID by name.
     * @params property name
     * @return integer property ID
     */
    public function getId($name) {
        return self::findOne(['name' => $name])->id;
	}
}
