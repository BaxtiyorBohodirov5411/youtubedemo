<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Videos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'title',
                'content'=>function($model){
                    return $this->render('video_item', ['model' => $model]);
                }
            ],
            // 'title'
            [
                'attribute'=>'status',
                'content'=>function($model){
                    return $model->getStatusLabels()[$model->status];
                }
            ],
            // 'describtion:ntext',
            // 'tags',
            //'has_thumbnail',
            //'video_name',
            'created_at:datetime',
            'updated_at:datetime',
            //'created_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=> function($url){
                        return "";
                    },
                    'update'=> function($url){
                        return "";
                    },
                    'delete'=> function($url){
                        return Html::a('delete', $url, $options = [
                            'data-method'=>'post',
                            'data-confirm'=>'Are you sure?'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
