<?php
    namespace frontend\controllers;

use common\models\Subscribes;
use common\models\User;
use common\models\Videos;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ChannelController extends Controller
    {
        public function behaviors()
        {
            return [
                'access'=>[
                        
                    'class'=>AccessControl::class,
                    'only'=>['subscribe'],
                    'rules'=>[
                        [
                                'allow'=>true,
                                'roles'=>['@']
                        ]
                    ]
                            
                ],
          ];
        }
        public function actionView($id)
        {
            // $this->layout="auth";
            $channel=$this->findChannel($id);
            $dataProvider=new ActiveDataProvider([
                'query'=>Videos::find()->creator($channel->id)->published()
            ]);
                return $this->render('view',['channel'=>$channel,'dataProvider'=>$dataProvider]);
        }   
        public function actionSubscribe($id)
        {
            $channel=$this->findChannel($id);
            // $channel=$this->findChannel($username);
            // return $channel;
            $isSubscribed=$channel->isSubscribed();
            if(!$isSubscribed)
            {
                $subscribe=new Subscribes();
                $subscribe->username=\Yii::$app->user->identity->username;
                $subscribe->channelname=$channel->username;
                $subscribe->subscribed_at=time();
                $subscribe->save();
                \Yii::$app->mailer->compose(
                    ['html'=>'subscriber-html','text'=>'subscriber-text'],
                    ['channel'=>$channel,'user'=>\Yii::$app->user->identity]
                )
                ->setFrom(\Yii::$app->params['adminEmail'])
                ->setTo($channel->email)
                ->setSubject("You have new subscriber!!!")
                ->send();
            }
            else {
                $isSubscribed->delete();
            }
            return $this->renderAjax('_subscribe_button',['channel'=>$channel]);
        }
        public function findChannel($id)
        {
            $channel=User::find()->andWhere(['id'=>$id])->one();
            if(!$channel)
            {
                throw new NotFoundHttpException("This channel does not found!");
            }   
            return $channel;
        }
    }

?>