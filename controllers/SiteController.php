<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller {


  public function behaviors() {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only'  => ['logout'],
        'rules' => [
          [
            'actions' => ['logout'],
            'allow'   => TRUE,
            'roles'   => ['@'],
          ],
        ],
      ],
      'verbs'  => [
        'class'   => VerbFilter::className(),
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  public function actions() {
    return [
      'error'   => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class'           => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : NULL,
      ],
    ];
  }

  public function actionIndex() {
    return $this->render('index');
  }

  public function actionLogin() {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }
    $model->password = '';
    return $this->render(
      'login', [
      'model' => $model,
    ]
    );
  }

  public function actionLogout() {
    Yii::$app->user->logout();
    return $this->goHome();
  }

}
