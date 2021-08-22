<?php
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var $channel \common\models\User */

?>
<div class="jumbotron">
    <h1 class="display-4"><?php echo $channel->username;?></h1>
    <hr class="my-4">
    <p class="lead">
        <?php Pjax::begin();?>
            <?php echo $this->render('_subscribe_button',['channel'=>$channel])?>
        <?php Pjax::end();?>
    </p>
</div>
<?php
    echo ListView::widget([
        'dataProvider'=>$dataProvider,
        'layout'=>'<div class="d-flex flex-wrap row p-4">{items}</div>{pager}',
        'itemView'=>'@frontend/views/Video/_video_item',
        'itemOptions'=>['tag'=>false]
    ])
?>