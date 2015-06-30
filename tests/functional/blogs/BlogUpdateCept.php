<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Update Blog Tests');


// Not signed tests
$I->amOnRoute('blog.edit', 47);
$I->seeCurrentUrlEquals('/auth/login');

// Sign in
$I->signIn();



// Update Blog
$I->amOnRoute('blog.edit', 47);
$I->see('Edit Blog');

$I->fillField('form input[name=title]', 'New Blog by FunctionalTester');
$I->selectOption('form select[name=category_id]', '2');
$I->fillField('form textarea[name=body]', 'bodybodybody \n by FunctionalTester');
$I->click('form [type=submit]');

$I->seeCurrentUrlMatches('~^/blog/(\d+)$~');
$I->seeCurrentRouteIs('blog.show', 47);
