<h1>Yii2 module for lookup dictionary</h1>

<h2>Advantages</h2>

Any dictionaries can be stored and used after that in a <code>Lookup</code> table. Values can be added or modified by migrations 
(You can see an example in <code>sergmoro1/yii2-user</code>).

<h2>Fields description</h2>
<ul>
  <li>id;</li>
  <li>name <code>string</code> - displayed name;</li>
  <li>code <code>integer</code> - code for saving in a model;</li>
  <li>type <code>string</code> - name of a group of values (for example <code>PostStatus</code>);</li>
  <li>position <code>integer</code> - value position in a list.</li>
</ul>

<h2>Installation</h2>

In app directory:

<pre>
$ composer require sergmoro1/yii2-lookup "dev-master"
</pre>

Run migration:
<pre>
$ php yii migrate --migrationPath=@vendor/sergmoro1/yii2-lookup/migrations
</pre>

<h2>Usage</h2>

In a module, that need a <code>Lookup</code>, add to requre section of <code>composer.json</code>:

<pre>
    "require": {
        ...
        "sergmoro1/yii2-lookup" : "*",
        ...
    },
</pre>

and create a migration with a new group (or groups) of values of dictionaries.
