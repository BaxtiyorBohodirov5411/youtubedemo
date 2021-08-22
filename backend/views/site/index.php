<?php
/** @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;

?>
<h1 style="text-align: center;">My videos</h1>
<?php
    echo ListView::widget([
        'dataProvider'=>$dataProvider,
        'layout'=>'<div class="d-flex flex-wrap row p-4">{items}</div>{pager}',
        'itemView'=>'video_item',
        'itemOptions'=>['tag'=>false]
    ])
?>