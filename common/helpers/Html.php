<?php
    namespace common\helpers;

use yii\helpers\Url;

class Html
    {
        public static function channelLink($user,$schema=false)
        {   
            return \yii\helpers\Html::a($user->username, Url::to(['/channel/view', 'id'=>$user->id], $schema));
        }
    }
?>