<?php
$I = new FunctionalTester($scenario);

$I->wantTo('Creating a new topic as a visitor or user.');

/**
 * Creating a new topic as a visitor
 */
$I->amOnPage('/topic/create');
$I->seeCurrentUrlEquals('/auth/login');



/**
 * Creating a new topic as a user
 */
$I->signIn();
$I->amOnPage('/topic/create');
$I->fillField('form input[name=title]', 'New Topic by FunctionalTester');
$I->selectOption('form select[name=node_id]', 'June');
$I->fillField('form textarea[name=body]', 'bodybodybody \n by FunctionalTester');
$I->click('form .btn[type=submit]');

$I->see('New Topic by FunctionalTester');
$I->seeCurrentUrlEquals('/topic');
