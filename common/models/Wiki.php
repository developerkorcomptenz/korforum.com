<?php

namespace common\models;

use Yii;


/**
 * This is the model class for table "wiki".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $teaser
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property string $featured_image
 *
 * @property User $user
 */
class Wiki extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wiki';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'teaser', 'content'], 'required'],
            [['user_id'], 'integer'],
            [['teaser', 'content'], 'string'],
            [['created_at', 'updated_at','featured_image'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['featured_image'],'file','extensions'=>'jpg,gif,png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'teaser' => 'Teaser',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'featured_image' => 'Featured Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
