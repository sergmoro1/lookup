<?php
/* @var $this yii\web\View */
/* @var $model models\Lookup */

use yii\helpers\Html;
use sergmoro1\lookup\Module;

$this->title = Module::t('core', 'Update');
$this->params['breadcrumbs'][] = ['label' => Module::t('core', 'Property\'s values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="lookup-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
