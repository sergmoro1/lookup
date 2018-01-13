<h1>Yii2 module for lookup dictionary</h1>

<h2>Advantages</h2>
<p>Any dictionaries can be stored and used after that in a <code>Lookup</code> table. Values can be added or modified by migrations 
(You can see an example in <code>sergmoro1/yii2-user</code>).
</p>

<h2>Fields description</h2>
<ul>
  <li>id;</li>
  <li>name <code>string</code> - displayed name;</li>
  <li>code <code>integer</code> - code for saving in a model;</li>
  <li>type <code>string</code> - name of a group of values (for example <code>PostStatus</code>);</li>
  <li>position <code>integer</code> - value position in a list.</li>
</ul>
