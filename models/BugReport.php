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
     * Screenshot file object
     * 
     * @var \yii\web\UploadedFile
     */
    public $screenshotFile;
    
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
            [['name', 'email', 'screenshot'], 'string', 'max' => 255],
            [['email'], 'email'],
            [
                'screenshotFile', 'image',
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
            'screenshotFile' => Yii::t('app', 'Screenshot'),
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

    /**
     * Register a new bug report
     *
     * @return boolean
     */
    public function registerBugReport() {
        $transaction = \Yii::$app->db->beginTransaction();
        //Assign screenshot property
        $this->screenshotFile = \yii\web\UploadedFile::getInstance($this, 'screenshotFile');
        if (!($this->screenshotFile instanceof \yii\web\UploadedFile)) {
            $this->addError('screenshotFile', \Yii::t('app', "Error while saving your screenshot. Please try again later."));
            $errorCode = $this->screenshotFile->error;
            \Yii::error("Error while validating file. File info" . print_r($_FILES, true));
            return false;
        }

        $this->screenshot = $this->screenshotFile->name;
        
        //Escape processing if saving error
        if (!$this->save()) {
            $transaction->rollBack();
            return false;
        }

        //Saving file
        if (!$this->saveScreenshot()) {
            $transaction->rollBack();
            $this->addError('screenshotFile', \Yii::t('app', "Error while saving your screenshot. Please try again later."));
            $errorCode = $this->screenshotFile->error;
            \Yii::error("Error while saving screenshot file. Error code: {$errorCode}\n File info: " . print_r($_FILES, true));
            return false;
        }

        $transaction->commit();
        return true;
    }

    /**
     * Save screenshot
     *
     * @return boolean
     */
    public function saveScreenshot() {
        $filePath = $this->getScreenshotFilePath();
        return $this->screenshotFile->saveAs($filePath);
    }

    /**
     * Get screenshot file path
     * The file stored at: @webroot/bug_report/id.extension
     *
     * @return string
     */
    public function getScreenshotFilePath() {
        $uploadPath = $this->getScreenshotUploadPath();
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath);
        }
        return $uploadPath . $this->id . "." . $this->screenshotFile->extension;
    }

    /**
     * Get base path to save screenshot
     * The file stored at: @webroot/bug_report/
     *
     * @return string
     */
    public function getScreenshotUploadPath () {
        return \Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'bug_report' . DIRECTORY_SEPARATOR;
    }
}
