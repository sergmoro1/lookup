<h1>Yii2 module for lookup enumeration values</h1>

<h2>Advantages</h2>
Some fields can has enumeration values (status: Draft (1), Published (2), Archived (3)).

Values can be added or modified by migrations or by interface. 
In a last case add lookup to the sidebar in <code>backend/config/params.php</code>:

<pre>
<?php
$sidebar = array_merge(
    require(__DIR__ . '/../../vendor/sergmoro1/yii2-blog-tools/src/config/sidebar.php'),
    require(__DIR__ . '/../../vendor/sergmoro1/yii2-user/src/config/sidebar.php'),
    require(__DIR__ . '/../../vendor/sergmoro1/yii2-lookup/src/config/sidebar.php')
);
return [
  ...
  'sidebar' => $sidebar,
];
</pre>

<h2>Installation</h2>

In app directory:

<pre>
$ composer require sergmoro1/yii2-lookup "dev-master"
</pre>

or add to requre section of <code>composer.json</code>.

<pre>
    "require": {
        ...
        "sergmoro1/yii2-lookup" : "*",
        ...
    },
</pre>

Run migration:
<pre>
$ php yii migrate --migrationPath=@vendor/sergmoro1/yii2-lookup/migrations
</pre>

<h2>Usage</h2>

All items by property.

<pre> 
// by property name
Lookup::items('PostStatus');
// by property ID
Lookup::items(1, true);
</pre>

The name of concrete item.

<pre> 
// by property name and code
Lookup::item('PostStatus', $data->status);
// by property ID and code
Lookup::item(1, $data->status, true);
</pre>
