<?php

use yii\helpers\Html;
use source\core\grid\GridView;
use source\LuLu;
use source\models\Content;
use source\libs\Constants;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$type='post';
$this->title = '日线MACD背离';
$this->params['breadcrumbs'][] = $this->title;


?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'columns' => [

            [
                'class'=>'source\core\grid\IdColumn',
            ],
    		
            [
                'attribute'=>'sCode',
                'headerOptions'=>['width'=>'auto'],
                'value' => function($model){
                    $url = \yii\helpers\Url::to(['info', 'code' => $model->sCode]);
                    return "<a href='{$url}'>{$model->sCode}</a>";
                }
            ],
            [
                'attribute'=>'sName',
                'headerOptions'=>['width'=>'auto'],
            ],
            [
                'attribute'=>'tBeginDateTime',
                'headerOptions'=>['width'=>'auto'],
            ],
//            [
//                'attribute'=>'tDeviateDateTime',
//                'headerOptions'=>['width'=>'auto'],
//            ],
            [
                'attribute'=>'tDateTime',
                'headerOptions'=>['width'=>'auto'],
            ],
            [
                'attribute'=>'iTurnoverRate',
                'headerOptions'=>['width'=>'auto'],
            ],
//            [
//                'attribute'=>'iBeginDif',
//                'headerOptions'=>['width'=>'auto'],
//            ],
//            [
//                'attribute'=>'iDeviateDif',
//                'headerOptions'=>['width'=>'auto'],
//            ],
            [
                'attribute'=>'iDirectionType',
                'value' => function($model){
                    return $model->iDirectionType == 2 ? "<b style='color:red'>↑</b>" : "<b style='color:#008000'>下</b>";
                },
                'headerOptions'=>['width'=>'auto'],
            ],
        ],
    ]); ?>

