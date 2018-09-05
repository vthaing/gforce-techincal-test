<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%bug_report}}".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $issue_description
 * @property int $user_id
 * @property string $screenshot
 * @property string $created_at
 */
class BugReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bug_report}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'issue_description'], 'required'],
            [['issue_description'], 'string'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [
                'screenshot', 'image',
                'maxWidth' => 800, 'maxHeight' => 600,
                'maxSize' => 1024 * 1024
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'issue_description' => Yii::t('app', 'Issue Description'),
            'user_id' => Yii::t('app', 'User ID'),
            'screenshot' => Yii::t('app', 'Screenshot'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BugReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BugReportQuery(get_called_class());
    }
}
