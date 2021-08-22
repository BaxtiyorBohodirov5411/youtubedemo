<?php
/** @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;

?>
<h1 class="p-4">Found videos</h1>
<?php

    echo ListView::widget([
        'dataProvider'=>$dataProvider,
        'layout'=>'<div class="d-flex flex-wrap row p-4">{items}</div>{pager}',
        'itemView'=>'_video_item',
        'itemOptions'=>['tag'=>false]
    ])
?>