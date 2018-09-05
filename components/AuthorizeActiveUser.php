<?php
namespace app\components;

use Yii;
use yii\base\ActionFilter;
/**
 * Authorize user is activated
 *
 * @author vanthai
 */
class AuthorizeActiveUser extends ActionFilter
{
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest || !\Yii::$app->user->identity->is_active) {
            $message = \Yii::t('app', "You are not allow to access this location");
            throw new \yii\web\UnauthorizedHttpException($message);
        }
        
        return parent::beforeAction($action);
    }
}
