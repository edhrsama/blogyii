<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $blog_post_id
 * @property integer $commented_by
 * @property string $comment
 * @property integer $status
 * @property integer $parent
 *
 * @property Post $commentedBy
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_post_id', 'commented_by', 'comment', 'status', 'parent'], 'required'],
            [['blog_post_id', 'commented_by', 'status', 'parent'], 'integer'],
            [['comment'], 'string'],
            [['commented_by'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['commented_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'blog_post_id' => Yii::t('app', 'Blog Post ID'),
            'commented_by' => Yii::t('app', 'Commented By'),
            'comment' => Yii::t('app', 'Comment'),
            'status' => Yii::t('app', 'Status'),
            'parent' => Yii::t('app', 'Parent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentedBy()
    {
        return $this->hasOne(Post::className(), ['id' => 'commented_by']);
    }
}
