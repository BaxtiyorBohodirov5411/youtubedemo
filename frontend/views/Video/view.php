<?php

/** @var $model common\models\Videos*/
/** @var $similarVideos common\models\Videos[] */

use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
?>
<div class="row">
    <div class="col-sm-7  m-0" style="padding:20px; box-sizing: border-box;">
        <div class="embed-responsive embed-responsive-16by9 m-1">
            <video controls id="video1" poster=<?= $model->getThumbnailLink() ?> class="embed-responsive-item" src=<?php echo $model->getVideoLink() ?>></video>
        </div>

        <div class="d-flex justify-content-between">
            <div>
                <a href="#" style="font-size:14px; text-decoration:none;"><?php
                    $a = "#" . join("#", explode(",", $model->tags));
                    $a = $a == "#" ? "" : $a;
                    echo $a; ?></a>
                <h5 class="m-0"><?php echo $model->title ?></h5>
                <p  style="font-size:14px;margin:0px;"><?php echo $model->getViews()->count()?> views
                 <?php echo date('j F Y', $model->created_at) ?></p>
            </div>
            <div>
                <?php \yii\widgets\Pjax::begin();?>
                    <?php echo $this->render('_buttons', ['model'=>$model]); ?>
                <?php yii\widgets\Pjax::end(); ?>
            </div>
        </div>
        <div>
            <p style="margin:0px;font-weight:bold;">
            <?php  echo \common\helpers\Html::channelLink($model->createdBy) ?>
        </p>
            <?php echo Html::encode($model->describtion)?>
        </div>
        
    </div>
    <div class="col-sm-4"style="padding-top:20px; box-sizing: border-box;">
        
    <?php
    foreach($similarVideos as $item):?>
                <div style="margin-bottom: 10px;" class="media row">
                    <a style="width:100%; margin-right:10px;" class="col-6 p-0" id="video_link" href=<?php echo Url::to(['video/view', 'id'=>$item->video_id])?>>
                        <div class="embed-responsive embed-responsive-16by9 m-1">
                            <video id="video1" poster=<?= $item->getThumbnailLink() ?> 
                                class="embed-responsive-item" src=<?php echo $item->getVideoLink() ?>>
                            </video>
                        </div>
                    </a>
                    <div class="media-body col-6 p-0">
                        <h5 class="m-0"><?php echo $item->title?></h5>
                        <p class="font-weight-bold m-0"><?php echo \common\helpers\Html::channelLink($item->createdBy)?></p>
                        <p class="text-muted m-0"><?php echo $item->getViews()->count()?> views </p>
                        <p class="text-muted m-0"><?php echo Yii::$app->formatter->asRelativeTime($item->created_at) ?></p> 
                        <!-- <p class="text-muted"><?php echo StringHelper::truncateWords($item->describtion,10)?></p>    -->
                    </div>
            </div>   
        <?php endforeach;?>    
    </div>
</div>
