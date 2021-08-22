<?php
/** @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;

?>
<?php
    echo ListView::widget([
        'dataProvider'=>$dataProvider,
        'layout'=>'<div class="d-flex flex-wrap row p-4">{items}</div>{pager}',
        'itemView'=>'_video_item',
        'itemOptions'=>['tag'=>false]
    ])
?>