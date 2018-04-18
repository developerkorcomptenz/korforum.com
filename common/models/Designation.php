<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "designation".
 *
 * @property int $id
 * @property string $designation_name
 * @property string $created_date
 * @property string $modified_date
 */
class Designation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'designation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['designation_name'], 'required'],
            [['created_date', 'modified_date'], 'safe'],
            [['designation_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'designation_name' => 'Designation Name',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }
}
