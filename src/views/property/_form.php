<?php
/* @var $this yii\web\View */
/* @var $model models\Property */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use sergmoro1\lookup\Module;
?>

<div class="property-form">

<?php $form = ActiveForm::begin([
    'id' => 'property-form',
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['property/validate']),        
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-6',
        ],
    ],
]); ?>

    <?= $form->field($model, 'name') ?>

    <?= Html::submitButton(Module::t('core', 'Submit'), ['id' => 'submit-btn', 'style' => 'display: none;']) ?>

<?php ActiveForm::end(); ?>

</div>
