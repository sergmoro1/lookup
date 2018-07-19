<?php
/* @var $this yii\web\View */
/* @var $model models\Property */

use yii\helpers\Html;
use sergmoro1\lookup\Module;

$this->title = Module::t('core', 'Update');
$this->params['breadcrumbs'][] = ['label' => Module::t('core', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="property-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
