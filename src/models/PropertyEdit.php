<?php
/**
 * The followings are the available columns in table 'property':
 * @var integer $id
 * @var string $name
 */
namespace sergmoro1\lookup\models;

use sergmoro1\lookup\Module;

class PropertyEdit extends Property
{
    private static $_items = [];
    const BARRIER = 100; // From this ID property can be modified, before BARRIER all values added by migrations
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => Module::t('core', 'Name'),
        );
    }
    
    public static function items() {
        if(self::$_items)
            return self::$_items;
        foreach(self::find()->where('id >= ' . self::BARRIER)->all() as $item)
            self::$_items[$item->id] = $item->name;
        return self::$_items;
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if(!$this->id && self::find()->orderBy(['id' => SORT_DESC])->one()->id < self::BARRIER)
                $this->id = self::BARRIER;
            return true;
        }
        else
            return false;
    }
}
