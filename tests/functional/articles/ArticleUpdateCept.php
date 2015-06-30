<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Update Article Tests');


// Not signed tests
$I->amOnRoute('article.edit', 19);
$I->seeCurrentUrlEquals('/auth/login');

// Sign in
$I->signIn();



// Update Article
$I->amOnRoute('article.edit', 19);
$I->see('Edit Article');

$I->fillField('form input[name=title]', 'New Article by FunctionalTester');
$I->selectOption('form select[name=category_id]', '1');
$I->fillField('form textarea[name=body]', 'bodybodybody \n by FunctionalTester');
$I->click('form [type=submit]');

$I->seeCurrentUrlMatches('~^/article/(\d+)$~');
$I->seeCurrentRouteIs('article.show', 19);
