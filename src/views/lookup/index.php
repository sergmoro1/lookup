<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

use sergmoro1\lookup\Module;
use sergmoro1\lookup\models\PropertyEdit As Property;

$this->registerJs('var popUp = {"id": "lookup", "actions": ["update"]};', yii\web\View::POS_HEAD);
sergmoro1\modal\assets\PopUpAsset::register($this);

$this->title = Module::t('core', 'Property\'s values');

echo Modal::widget([
    'id' => 'lookup-win',
    'toggleButton' => false,
    'header' => $this->title,
    'footer' => 
        '<button type="button" class="btn btn-default" data-dismiss="modal">'. Module::t('core', 'Cancel') .'</button>'. 
        '<button type="button" class="btn btn-primary">'. Module::t('core', 'Save') .'</button>',
]);

?>

<div class="lookup-index">

<div class='row'>
<div class='col-sm-8'>
    <p>
        <?= Html::a(\Yii::$app->params['icons']['plus'] . ' ' . Module::t('core', 'Add'), ['create'], [
            'id' => 'lookup-add',
            'data-toggle' => 'modal',
            'data-target' => '#lookup-win',
            'class' => 'btn btn-success',
        ]) ?>
    </p>
    
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['style' => 'width:4%;'],
            ],
            [
                'attribute' => 'property_id',
                'filter' => Property::items(),
                'value' => function($data) {
                    return $data->property->name;
                }
            ],
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:10%;'],
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a(
                            \Yii::$app->params['icons']['pencil'], 
                            $url, [
                                'class' => 'update',
                                'data-toggle' => 'modal',
                                'data-target' => '#lookup-win',
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
    </div>

</div>

<div class='col-sm-4'>
    <?= $this->render('help') ?>
</div>

</div> <!-- ./row -->
</div> <!-- ./tag-index -->
