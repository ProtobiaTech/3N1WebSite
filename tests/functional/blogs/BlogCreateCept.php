<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Create Blog Tests');

// Not signed tests
$I->amOnRoute('blog.create');
$I->seeCurrentUrlEquals('/auth/login');

// Sign in
$I->signIn();



// Create blog
$I->amOnRoute('blog.create');
$I->see('Create Blog');

$I->fillField('form input[name=title]', 'New Blog by FunctionalTester');
$I->selectOption('form select[name=category_id]', '2');
$I->fillField('form textarea[name=body]', 'bodybodybody \n by FunctionalTester');
$I->click('form [type=submit]');

$I->seeCurrentUrlMatches('~^/blog/(\d+)$~');
