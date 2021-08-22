<?php
/** @var $channel  common\models\User*/
use yii\helpers\Url;
?>
  <a  data-pjax="1" data-method="POST" class="btn <?php echo $channel->isSubscribed()?"btn-secondary":"btn-danger" ?>" 
  href=<?php echo Url::to(['channel/subscribe','id'=>$channel->id])?> 
  role="button">Subscribe <i class="far fa-bell"></i>
</a> <?php echo $channel->getSubscribes()->count();?>
        