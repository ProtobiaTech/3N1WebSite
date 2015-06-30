<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Create Article Tests');

// Not signed tests
$I->amOnRoute('article.create');
$I->seeCurrentUrlEquals('/auth/login');

// Sign in
$I->signIn();



// Create article
$I->amOnRoute('article.create');
$I->see('Create Article');

$I->fillField('form input[name=title]', 'New Article by FunctionalTester');
$I->selectOption('form select[name=category_id]', '1');
$I->fillField('form textarea[name=body]', 'bodybodybody \n by FunctionalTester');
$I->click('form [type=submit]');

$I->seeCurrentUrlMatches('~^/article/(\d+)$~');
