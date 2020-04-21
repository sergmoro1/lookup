<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

use sergmoro1\lookup\Module;

$this->registerJs('var popUp = {"id": "property", "actions": ["update"]};', yii\web\View::POS_HEAD);
sergmoro1\modal\assets\PopUpAsset::register($this);

$this->title = Module::t('core', 'Properties');

echo Modal::widget([
    'id' => 'property-win',
    'toggleButton' => false,
    'header' => $this->title,
    'footer' => 
        '<button type="button" class="btn btn-default" data-dismiss="modal">'. Module::t('core', 'Cancel') .'</button>'. 
        '<button type="button" class="btn btn-primary">'. Module::t('core', 'Save') .'</button>',
]);

?>

<div class="property-index">

<div class='row'>
<div class='col-sm-8'>
    <p>
        <?= Html::a(\Yii::$app->params['icons']['plus'] . ' ' . Module::t('core', 'Add'), ['create'], [
            'id' => 'property-add',
            'data-toggle' => 'modal',
            'data-target' => '#property-win',
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
                                'data-target' => '#property-win',
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
