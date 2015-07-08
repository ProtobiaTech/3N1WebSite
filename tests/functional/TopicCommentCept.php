<?php
$I = new FunctionalTester($scenario);

$I->wantTo('Creating a topic-comment as a user.');

$I->signIn();
$I->amOnPage('/topic/1');
$I->fillField('form textarea[name=body]', 'bodybodybody \n by FunctionalTester');
$I->click('form .btn[type=submit]');

$I->see('bodybodybody \n by FunctionalTester');
$I->seeCurrentUrlEquals('/topic/1');
