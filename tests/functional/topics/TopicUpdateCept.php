<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Update Topic Tests');


// Not signed tests
$I->amOnRoute('topic.edit', 1);
$I->seeCurrentUrlEquals('/auth/login');

// Sign in
$I->signIn();



// Update topic
$I->amOnRoute('topic.edit', 1);
$I->see('Edit Topic');

$I->fillField('form input[name=title]', 'New Topic by FunctionalTester');
$I->selectOption('form select[name=node_id]', '4');
$I->fillField('form textarea[name=body]', 'bodybodybody \n by FunctionalTester');
$I->click('form [type=submit]');

$I->seeCurrentUrlMatches('~^/topic/(\d+)$~');
$I->seeCurrentRouteIs('topic.show', 1);
