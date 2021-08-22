<?php

namespace frontend\controllers;


use yii;
use common\models\VideoLike;
use common\models\Videos;
use common\models\VideoViews;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{
    public function behaviors()
    {
      return [
          'access'=>[
              'class'=>AccessControl::class,
              'only'=>['like','dislike','history'],
              'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ]
                ],
            ],
            'verb'=>[
                'class'=>VerbFilter::class,
                'actions'=>[
                    'like'=>['post'],
                    'dislike'=>['post']
                ]
            ]
            ];   
    }
    public function actionIndex()
    {
        $dataProvider=new ActiveDataProvider(
            [
                'query'=> Videos::find()->published()->latest()
            ]
        );
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }
    public function actionView($id)
    {
        $this->layout='auth';
        $video=$this->findVideo($id);
        $videoView=new VideoViews();
        $videoView->video_id=$id;
        $videoView->user_id =Yii::$app->user->id;
        $videoView->created_at=time();
        $videoView->save();

        $similarVideos=Videos::find()
        ->published()
        ->andWhere(['NOT',['video_id'=>$id]])
        ->byKeyword($video->title)
        ->limit(10)
        ->all();
        return $this->render('view',[
            'model'=> $video,
            'similarVideos'=>$similarVideos
        ]);
    }
    public function actionLike($id)
    {
        $user_id=Yii::$app->user->id;
        $video=$this->findVideo($id);
        $videoLikeDislike=VideoLike::isVideoLiked($id,$user_id);
        if(!$videoLikeDislike)
        {
            $this->saveLikeDislike($id,$user_id,VideoLike::TYPE_LIKE);
        }
        else if($videoLikeDislike->type==VideoLike::TYPE_LIKE)
        {
            $videoLikeDislike->delete();
        }
        else{
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id,$user_id,VideoLike::TYPE_LIKE);

        }
        
        return $this->renderAjax('_buttons',['model'=>$video]);
        
    }
    public function actionDislike($id)
    {
        $user_id=Yii::$app->user->id;
        $video=$this->findVideo($id);
        $videoLikeDislike=VideoLike::isVideoLiked($id,$user_id);
        if(!$videoLikeDislike)
        {
            $this->saveLikeDislike($id,$user_id,VideoLike::TYPE_DISLIKE);
        }
        else if($videoLikeDislike->type==VideoLike::TYPE_DISLIKE)
        {
            $videoLikeDislike->delete();
        }
        else{
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id,$user_id,VideoLike::TYPE_DISLIKE);

        }
        
        return $this->renderAjax('_buttons',['model'=>$video]);
        
    }
    protected function findVideo($id)
    {
        $video=Videos::findOne($id);
        if(!$video)
        {   
            throw new NotFoundHttpException("Video does not found!");    
        }
        return $video;
    }
    protected function saveLikeDislike($id,$user_id,$type)
    {
        $videoLike=new VideoLike();
        $videoLike->video_id=$id;
        $videoLike->user_id=$user_id;
        $videoLike->type=$type;
        $videoLike->created_at=time();
        $videoLike->save();
    }
    public function actionSearch($keyword)
    {
        $query= Videos::find()->published()->latest();
        if($keyword)
        {
            $query->byKeyword($keyword);
        }

        $dataProvider=new ActiveDataProvider(
            [
                'query'=>$query
            ]
        );
        return $this->render('search',['dataProvider'=>$dataProvider]);
          
    } 
    public function actionHistory()
    {
        $history=Videos::getHistory();
        // $dataProvider=new ActiveDataProvider(
        //     [
        //         'query'=>$history
        //     ]
        // );
        return $this->render('history',['views'=>$history]);
    }
}
  
?>