<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model {

  public $username;

  public $password;

  private $_user = FALSE;

  public function rules() {
    return [
      // username and password are both required
      [['username', 'password'], 'required'],
      // password is validated by validatePassword()
      ['password', 'validatePassword'],
    ];
  }

  public function validatePassword($attribute, $params) {
    if (!$this->hasErrors()) {
      $user = $this->getUser();
      if (!$user || !$user->validatePassword($this->password)) {
        $this->addError($attribute, 'Incorrect username or password.');
      }
    }
  }

  public function login() {
    if ($this->validate()) {
      return Yii::$app->user->login($this->getUser(), 0);
    }
    return FALSE;
  }

  public function getUser() {
    if ($this->_user === FALSE) {
      $this->_user = User::findByUsername($this->username);
    }
    return $this->_user;
  }
}
