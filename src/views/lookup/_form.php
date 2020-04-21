<?php
/* @var $this yii\web\View */
/* @var $model models\Lookup */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use sergmoro1\lookup\Module;
use sergmoro1\lookup\models\PropertyEdit as Property;
?>

<div class="lookup-form">

<?php $form = ActiveForm::begin([
    'id' => 'lookup-form',
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['lookup/validate']),        
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-6',
        ],
    ],
]); ?>

    <?= $form->field($model, 'property_id')->dropdownList(Property::items(), [
        'prompt' => Module::t('core', 'Select'),
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'position') ?>

    <?= Html::submitButton(Module::t('core', 'Submit'), ['id' => 'submit-btn', 'style' => 'display: none;']) ?>

<?php ActiveForm::end(); ?>

</div>
