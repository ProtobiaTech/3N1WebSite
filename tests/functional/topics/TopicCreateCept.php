<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Create Topic Tests');

// Not signed tests
$I->amOnRoute('topic.create');
$I->seeCurrentUrlEquals('/auth/login');

// Sign in
$I->signIn();



// Create topic
$I->amOnRoute('topic.create');
$I->see('Create Topic');

$I->fillField('form input[name=title]', 'New Topic by FunctionalTester');
$I->selectOption('form select[name=category_id]', '4');
$I->fillField('form textarea[name=body]', 'bodybodybody \n by FunctionalTester');
$I->click('form [type=submit]');

$I->seeCurrentUrlMatches('~^/topic/(\d+)$~');
