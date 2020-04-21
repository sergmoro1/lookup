<?php
namespace sergmoro1\lookup\models;

use sergmoro1\lookup\Module;

class LookupEdit extends Lookup
{
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return [
            [['name', 'code', 'property_id'], 'required'],
            [['code', 'property_id', 'position'], 'integer'],
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
            'code' => Module::t('core', 'Code'),
            'property_id' => Module::t('core', 'Property'),
            'position' => Module::t('core', 'Position'),
        );
    }
}
