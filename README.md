Yii2 module for lookup enumeration values
=========================================

Advantages
----------

Fields can has enumeration values. For exaple for a post status:

```php
'status' => [
    1 => 'Draft', 
    2 => 'Published',
    3 => 'Archived',
]
```
If the number of enumerable values is limited, it is convenient to store them in one table.

Values for modules can be added by migrations or by interface. 

Installation
------------

The preferred way to install this extension is through composer.

Either run

`composer require --prefer-dist sergmoro1/yii2-lookup`

or add

`"sergmoro1/yii2-lookup": "^1.1"`

to the require section of your composer.json.

Run migration
`php yii migrate --migrationPath=@vendor/sergmoro1/yii2-lookup/src/migrations`

Usage
-----

Values for modules can be added by migrations 

```php
use yii\db\Migration;

class m180116_073828_lookup_fill extends Migration
{
    const TABLE_LOOKUP   = '{{%lookup}}';
    const TABLE_PROPERTY = '{{%property}}';
    
    const USER_ROLE   = 1;
    const USER_STATUS = 2;

    public function safeUp()
    {
        $this->insert(self::TABLE_PROPERTY, ['id' => self::USER_ROLE, 'name' => 'UserRole']);
        $this->insert(self::TABLE_LOOKUP, ['name' => 'Admin',       'code' => 1, 'property_id' => self::USER_ROLE, 'position' => 1]);
        $this->insert(self::TABLE_LOOKUP, ['name' => 'Author',      'code' => 2, 'property_id' => self::USER_ROLE, 'position' => 2]);
        $this->insert(self::TABLE_LOOKUP, ['name' => 'Commentator', 'code' => 3, 'property_id' => self::USER_ROLE, 'position' => 3]);

        $this->insert(self::TABLE_PROPERTY, ['id' =>  self::USER_STATUS, 'name' => 'UserStatus']);
        $this->insert(self::TABLE_LOOKUP, ['name' => 'Active',  'code' => 1, 'property_id' => self::USER_STATUS, 'position' => 1]);
        $this->insert(self::TABLE_LOOKUP, ['name' => 'Archive', 'code' => 2, 'property_id' => self::USER_STATUS, 'position' => 2]);
    }

    public function safeDown()
    {
        $this->delete(self::TABLE_LOOKUP, 'property_id=' . self::USER_ROLE);
        $this->delete(self::TABLE_LOOKUP, 'property_id=' . self::USER_STATUS);
        $this->delete(self::TABLE_PROPERTY, self::USER_ROLE);
        $this->delete(self::TABLE_PROPERTY, self::USER_STATUS);
    }
}
```

or by interface and then place the links in a menu or sidebar.

```php
<?= Html::a('Properties', ['lookup/property/index']) ?>
<?= Html::a('Property\'s values', ['lookup/lookup/index']) ?>
```

To get all items by property.

```php
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
            'username',
            'email',
            [
                'attribute' => 'status',
                'filter' => Lookup::items('UserStatus'),
                'value' => function($data) {
                    return Lookup::item('UserStatus', $data->status);
                }
            ],
```

To get the name of concrete item.

```php
Lookup::item('PostStatus', $data->status);
```
