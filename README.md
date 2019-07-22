Yii2 module for lookup enumeration values
=========================================

Advantages
----------

Fields can has enumeration values. For exaple

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

`"sergmoro1/yii2-lookup": "~2.0"`

to the require section of your composer.json.

Run migration
`php yii migrate --migrationPath=@vendor/sergmoro1/yii2-lookup/migrations`

Usage
-----

Values for modules can be added by migrations or by interface.

In a last case add lookup to the sidebar in `backend/config/params.php`.

```php
$sidebar = array_merge(
    require(__DIR__ . '/../../vendor/sergmoro1/yii2-blog-tools/src/config/sidebar.php'),
    require(__DIR__ . '/../../vendor/sergmoro1/yii2-user/src/config/sidebar.php'),
    require(__DIR__ . '/../../vendor/sergmoro1/yii2-lookup/src/config/sidebar.php')
);
return [
  ...
  'sidebar' => $sidebar,
];
```

To get all items by property.

```php
Lookup::items('PostStatus');
```

To get the name of concrete item.

```php
Lookup::item('PostStatus', $data->status);
```
