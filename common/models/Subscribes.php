<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subscribes}}".
 *
 * @property int $id
 * @property string $username
 * @property string $channelname
 * @property int|null $subscribed_at
 */
class Subscribes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subscribes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'channelname'], 'required'],
            [['subscribed_at'], 'integer'],
            [['username'], 'string', 'max' => 25],
            [['channelname'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'channelname' => 'Channelname',
            'subscribed_at' => 'Subscribed At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SubscribesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SubscribesQuery(get_called_class());
    }
}
