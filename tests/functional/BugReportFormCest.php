<?php

class BugReportFormCest
{

    public function openBugReportPageWithoutLogginIn(\FunctionalTester $I) {
        $I->amOnPage(['assessment/index']);
        $I->dontSee('Report a bug', 'h2');
    }

    public function submitEmptyForm(\FunctionalTester $I) {
        $I->amLoggedInAs(1);
        $I->amOnPage(['assessment/index']);
        $I->submitForm('#assessment-form', []);
        $I->expectTo('see validations errors');
        $I->see('Report a bug', 'h2');
        $I->see('Name cannot be blank');
        $I->see('Email cannot be blank');
        $I->see('Issue description cannot be blank');
    }

    public function submitFormSuccessfully(\FunctionalTester $I) {
        $I->amLoggedInAs(1);
        $I->amOnPage(['assessment/index']);
        $I->submitForm(
            '#assessment-form',
            [
                'BugReport[name]' => 'tester',
                'BugReport[email]' => 'tester@example.com',
                'BugReport[issue_description]' => 'test content',
            ]
        );
        $I->seeEmailIsSent();
        $I->dontSeeElement('#assessment-form');
        $I->see(
            'Thank you for reporting this bug, we will respond to you via email shortly.'
        );
    }

    public function attachFileTooLarge(\FunctionalTester $I) {
        $I->amLoggedInAs(1);
        $I->amOnPage(['assessment/index']);
        $I->fillField('BugReport[name]', 'vanthai');
        $I->fillField('BugReport[email]', 'vthaing@gmail.com');
        $I->fillField('BugReport[issue_description]', 'Hello, i am testing bug report');
        $I->attachFile('#bugreport-screenshotfile', 'Chrysanthemum.jpg');
        $I->click("#assessment-form button[type=submit]");
        $I->canSee("The width cannot be larger than 800 pixels");
    }

    
    public function attachFileIsNotImage(\FunctionalTester $I) {
        $I->amLoggedInAs(1);
        $I->amOnPage(['assessment/index']);
        $I->fillField('BugReport[name]', 'vanthai');
        $I->fillField('BugReport[email]', 'vthaing@gmail.com');
        $I->fillField('BugReport[issue_description]', 'Hello, i am testing bug report');
        $I->attachFile('#bugreport-screenshotfile', 'NguyenVanThai.pdf');
        $I->click("#assessment-form button[type=submit]");
        $I->canSee('The file "NguyenVanThai.pdf" is not an image');
    }

    public function attachFileSuccess(\FunctionalTester $I) {
        $I->amLoggedInAs(1);
        $I->amOnPage(['assessment/index']);
        $I->fillField('BugReport[name]', 'vanthai');
        $I->fillField('BugReport[email]', 'vthaing@gmail.com');
        $I->fillField('BugReport[issue_description]', 'Hello, i am testing bug report');
        $I->attachFile('#bugreport-screenshotfile', 'product11.jpg');
        $I->click("#assessment-form button[type=submit]");
        
        $I->dontSeeElement('#assessment-form');
        $I->see(
            'Thank you for reporting this bug, we will respond to you via email shortly.'
        );
    }

}
