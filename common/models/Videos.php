<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
//use Faker\Provider\Image;
use Imagine\image\Box;
use yii\imagine\Image;
use  yii\validators\FileValidator;


/**
 * This is the model class for table "{{%videos}}".
 *
 * @property string $video_id
 * @property string|null $title
 * @property string|null $describtion
 * @property string|null $tags
 * @property int|null $status
 * @property int|null $has_thumbnail
 * @property string|null $video_name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Videos extends \yii\db\ActiveRecord
{
    const  STATUS_UNLISTED=0;
    const  STATUS_PUBLISHED=1;

    public $video;
    public $thumbnail;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%videos}}';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class'=>BlameableBehavior::class,
                'updatedByAttribute'=>false
            ]
        ];
    }
    public function getStatusLabels()
    {
        return[
        self::STATUS_PUBLISHED=>'Published',
        self::STATUS_UNLISTED=>'Unlisted'
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id'], 'required'],
            [['describtion'], 'string'],
            [['status', 'has_thumbnail', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['title', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            ['status','default','value'=>self::STATUS_UNLISTED],
            ['has_thumbnail','default', 'value'=>0],
            ['thumbnail','image'],
            ['video','file','extensions'=>['mp4']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => 'Video ID',
            'title' => 'Title',
            'describtion' => 'Describtion',
            'tags' => 'Tags',
            'status' => 'Status',
            'has_thumbnail' => 'Has Thumbnail',
            'video_name' => 'Video Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'thumbnail'  =>  'Thumbnail'
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideosQuery(get_called_class());
    }
    public function save($runvalidation=true,$attributeNames=null)
    {
        $isInsert=$this->isNewRecord;
        if($isInsert)
        {
            $this->video_id=yii::$app->security->generateRandomString(8);
            $this->title=$this->video->name;
            $this->video_name=$this->video->name;
        }
        if($this->thumbnail)
        {
            $this->has_thumbnail=1;
        }
        $saved= parent::save($runvalidation,$attributeNames);
        if(!$saved)
        {
            return false;
        }
        if($isInsert)
        {
            $videoPath=Yii::getAlias('@frontend/web/storage/videos/'.$this->video_id.'.mp4');
            if(!is_dir(dirname($videoPath)))
            {
                FileHelper::createDirectory(dirName($videoPath));
            }
            echo $videoPath;
            $this->video->saveAs($videoPath);
        }
        if($this->thumbnail)
        {
            $thumbnailPath=Yii::getAlias('@frontend/web/storage/images/'.$this->video_id.'.jpg');
            if(!is_dir(dirname($thumbnailPath)))
            {
                FileHelper::createDirectory(dirName($thumbnailPath));
            }
            $this->thumbnail->saveAs($thumbnailPath);
            Image::getImagine()
            ->open($thumbnailPath)
            ->thumbnail(new Box(1280,1280))
            ->save();
        }
        return true;
    }
    // public function saveImage($runvalidation=true,$attributeNames=null)
    // {
       
    //         $imagePath=Yii::getAlias('@frontend/web/storage/images/'.$this->thumbnail);
    //         echo $imagePath;
    //         if(!is_dir(dirname($imagePath)))
    //         {
    //             FileHelper::createDirectory(dirName($imagePath));
    //         }
    //         echo is_null($this->image."<br>");
    //         // $this->image->saveAs($imagePath);
    //     return true;
    // }
    public function getViews()
    {
        // ->where(['user_id'=>$id])->andWhere()->orderBy(['created_at',SORT_DESC])->all()

        return $this->hasMany(VideoViews::class,['video_id'=>'video_id']);
    }
    public function getLikes()
    {
        return $this->hasMany(VideoLike::class,['video_id'=>'video_id']);
    }
    public function getVideoLink()
    {
        return Yii::$app->params['frontendUrl']."web/storage/videos/".$this->video_id.".mp4";
    }
    public function getThumbnailLink()
    {
        return $this->has_thumbnail? Yii::$app->params['frontendUrl']."web/storage/Images/".$this->video_id.".jpg":'';
    }
    public static function getHistory()
    {
        return VideoViews::find()->andWhere(['user_id'=>Yii::$app->user->identity->id])->groupBy('video_id')
        ->select("video_id, user_id, MAX(created_at) as created_at")->orderBy(['created_at'=>SORT_DESC])->all();
    }
    public function afterDelete()
    {
        parent::afterDelete();
        $videoPath=Yii::getAlias('@frontend/web/storage/videos/'.$this->video_id.'.mp4');
        if(file_exists($videoPath))
        {
            unlink($videoPath);
        }
        $thumbnailPath=Yii::getAlias('@frontend/web/storage/images/'.$this->video_id.'.jpg');
        if(file_exists($thumbnailPath))
        {
            unlink($thumbnailPath);
        }
    }
}
