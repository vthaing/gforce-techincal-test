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
            '#assessment-form', [
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

}
