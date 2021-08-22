<?php
/** @var $views common\models\VideoViews */

use common\models\Videos;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\ListView;


?>
<h1 style="margin:10px 0px 0px 10px; text-align:center">History</h1>
<div class="row p-4">
<?php
    
    foreach($views as $item):

            $video=Videos::findOne($item->video_id);

           echo $this->render('_video_item',['model'=>$video,'view'=>$item]);
?>
<?php endforeach;?>   
</div>