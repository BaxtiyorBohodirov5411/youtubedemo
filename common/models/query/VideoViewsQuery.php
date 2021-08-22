<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\VideoViews]].
 *
 * @see \common\models\VideoViews
 */
class VideoViewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\VideoViews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\VideoViews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
