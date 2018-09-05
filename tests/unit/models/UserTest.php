<?php

namespace tests\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('admin');
        
        expect_not(User::findIdentity(999)->id);
    }


    public function testFindUserByUsername()
    {
        expect_that(User::findByUsername('admin')->username == 'admin');
        expect_that(User::findByUsername('disabled')->username == 'disabled');
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('admin');

        expect_that($user->validatePassword('test'));
        expect_not($user->validatePassword('123456'));        
    }

}
