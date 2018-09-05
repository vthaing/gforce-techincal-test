<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\BugReport;
use Yii;

class AssessmentController extends Controller
{

    public function actionIndex() {
        $model = new BugReport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $successMessage = "Thank you for reporting this bug, we will respond to you via email shortly.";
            \Yii::$app->session->setFlash('default', \Yii::t('bug-report', $successMessage));
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
