<?php
/** @var $model common\models\Videos*/

use common\models\VideoLike;
use yii\helpers\Url;

?>
<a data-method="POST" data-pjax="1" href=<?php echo Url::to(['/video/like','id'=>$model->video_id]); ?> 
    class="btn 
    <?php echo VideoLike::isVideoLiked($model->video_id,Yii::$app->user->id)
    &&VideoLike::isVideoLiked($model->video_id,Yii::$app->user->id)->type==VideoLike::TYPE_LIKE? 
    "btn-outline-primary":"btn-outline-secondary" ?>" >
    <i class="far fa-thumbs-up"></i><?php echo $model->getLikes()->andWhere(['type'=>VideoLike::TYPE_LIKE])->count();?>
</a>
<a data-method="POST" data-pjax="1" href=<?php echo Url::to(['/video/dislike','id'=>$model->video_id]); ?> 
    class="btn 
    <?php echo VideoLike::isVideoLiked($model->video_id,Yii::$app->user->id)
    && VideoLike::isVideoLiked($model->video_id,Yii::$app->user->id)->type==VideoLike::TYPE_DISLIKE? 
    "btn-outline-primary":"btn-outline-secondary" ?>" >
    <i class="far fa-thumbs-down"></i><?php echo $model->getLikes()->andWhere(['type'=>VideoLike::TYPE_DISLIKE])->count();?>
</a>
