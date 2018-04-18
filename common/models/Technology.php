<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "technology".
 *
 * @property int $id
 * @property string $technology_name
 * @property string $created_date
 * @property string $modified_date
 */
class Technology extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'technology';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['technology_name'], 'required'],
            [['created_date', 'modified_date'], 'safe'],
            [['technology_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'technology_name' => 'Technology Name',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }
}
