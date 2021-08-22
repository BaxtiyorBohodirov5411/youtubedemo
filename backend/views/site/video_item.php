<?php
/** @var $model  common\models\Videos*/
/** @var $view  common\models\VideoViews*/

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>
   
<a id="video_link" class="col-12 col-sm-6 col-md-4 col-xl-3 p-1" style="color:black;  text-decoration: none;" href=<?php echo Url::to($model->getVideoLink())?>>
    <div class="card" style="width:100%; padding:2px">
        <div class="embed-responsive embed-responsive-16by9">
            <video id="video1" poster=<?=$model->getThumbnailLink()?> 
            class="embed-responsive-item" src=<?php echo $model->getVideoLink()?>></video>
        </div>
    <div class="card-body p-2">
        <h5 class="card-title m-0"><?php echo StringHelper::truncateWords($model->title,5)?></h5>
            
        <p class="text-muted card-text  m-0"><?=$model->getViews()->count()?> views
            <?php echo Yii::$app->formatter->asRelativeTime($view?$view->created_at:$model->created_at)?></p>
    </div>
    </div>
</a>