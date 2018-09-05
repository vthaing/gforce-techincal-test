<?php

namespace tests\models;

class BugReportTest extends \Codeception\Test\Unit
{

    /**
     * @var \UnitTester
     */
    protected $tester;
    private $model;

    protected function _before() {

    }

    protected function _after() {

    }

    // tests
    public function testInvalidAllData() {
        $data = [
            'name' => '',
            'email' => '',
            'issue_description' => ''
        ];

        $this->model = new \app\models\BugReport($data);
        expect_not($this->model->registerBugReport());

        $errorMessages = $this->model->getErrors();
        foreach ($data as $key => $value) {
            $this->assertArrayHasKey($key, $errorMessages);
        }
    }


    public function testInvalidEmail() {
        $data = [
            'name' => 'test name',
            'email' => '',
            'issue_description' => 'test isssue description'
        ];

        $this->model = new \app\models\BugReport($data);
        expect_not($this->model->registerBugReport());

        $errorMessages = $this->model->getErrors();
        $this->assertArrayHasKey('email', $errorMessages);
        $this->assertArrayNotHasKey('name', $errorMessages);
        $this->assertArrayNotHasKey('issue_description', $errorMessages);


        $data = [
            'name' => 'test name',
            'email' => 'ssss',
            'issue_description' => 'test isssue description'
        ];

        $this->model = new \app\models\BugReport($data);
        expect_not($this->model->registerBugReport());
        $this->assertArrayHasKey('email', $errorMessages);
        $this->assertArrayNotHasKey('name', $errorMessages);
        $this->assertArrayNotHasKey('issue_description', $errorMessages);

    }

    public function testDataOk() {
        $data = [
            'name' => 'test name',
            'email' => 'vthaing@gmail.com',
            'issue_description' => 'test isssue description'
        ];

        $this->model = new \app\models\BugReport($data);
        expect_that($this->model->registerBugReport());
        $errorMessages = $this->model->getErrors();
        expect_not($errorMessages);
    }


    public function testDataTooLong() {
        $data = [
            'name' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor feugiat pellentesque. Nunc et velit nec lacus varius porttitor. Vivamus sagittis lacus vitae mi molestie, in vulputate quam hendrerit. Nunc et elit sit amet leo pretium feugiat. Cras elit risus, vehicula nec condimentum ac, hendrerit vel purus. Quisque aliquam purus vulputate, maximus est ut, ultrices neque. Donec volutpat, risus a euismod interdum, lacus mi pretium velit, in vulputate augue lacus id enim. Nullam felis eros, vehicula eget nulla id, eleifend porta orci. Maecenas id diam sed enim luctus maximus. Quisque et nulla eu augue hendrerit tristique eget in sem. Suspendisse rutrum id odio sed vehicula. Nullam interdum porta turpis, eu feugiat felis lobortis vitae. Ut viverra diam ut nisi molestie interdum. Mauris eget ultricies tortor. Morbi eu mattis ipsum. Sed ornare tempor eros, vitae pharetra diam molestie et.',
            'email' => 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc@gmail.com',
            'issue_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor feugiat pellentesque. Nunc et velit nec lacus varius porttitor. Vivamus sagittis lacus vitae mi molestie, in vulputate quam hendrerit. Nunc et elit sit amet leo pretium feugiat. Cras elit risus, vehicula nec condimentum ac, hendrerit vel purus. Quisque aliquam purus vulputate, maximus est ut, ultrices neque. Donec volutpat, risus a euismod interdum, lacus mi pretium velit, in vulputate augue lacus id enim. Nullam felis eros, vehicula eget nulla id, eleifend porta orci. Maecenas id diam sed enim luctus maximus. Quisque et nulla eu augue hendrerit tristique eget in sem. Suspendisse rutrum id odio sed vehicula. Nullam interdum porta turpis, eu feugiat felis lobortis vitae. Ut viverra diam ut nisi molestie interdum. Mauris eget ultricies tortor. Morbi eu mattis ipsum. Sed ornare tempor eros, vitae pharetra diam molestie et.'
        ];

        $this->model = new \app\models\BugReport($data);
        expect_not($this->model->registerBugReport());
        $errorMessages = $this->model->getErrors();

        $this->assertArrayHasKey('email', $errorMessages);
        $this->assertArrayHasKey('name', $errorMessages);
        $this->assertArrayNotHasKey('issue_description', $errorMessages);
    }

}
