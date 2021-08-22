<?php
/** @var $model \common\models\Video */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
<div class="media">
  <a href=<?php echo Url::to(['/videos/update','id'=>$model->video_id])?>>
     <div class="embed-responsive embed-responsive-16by9 mr-2" style="width:140px;">
          <video id="video1" poster=<?=Yii::$app->params['frontendUrl']."web/storage/images/".$model->video_id.".jpg"?> 
          class="embed-responsive-item shadow" src=<?php echo $model->getVideoLink() ?> ></video>
      </div>
  </a>
  
  <div class="media-body">
        <h5 class="mt-0"><?php echo $model->title?></h5>
        <?php echo StringHelper::truncateWords($model->describtion,10); ?>
</div>
</div>
