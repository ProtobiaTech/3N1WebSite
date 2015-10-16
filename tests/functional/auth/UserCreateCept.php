<?php
$I = new FunctionalTester($scenario);
$I->wantTo('Create User');

// Create user
$I->amOnPage('/auth/register');
$I->seeCurrentUrlEquals('/auth/register');

$I->fillField('form input[name=email]', time() . '@3n1website.com');
$I->fillField('form input[name=name]', time() . 'name');
$I->fillField('form input[name=password]', '3n1website');
$I->fillField('form input[name=password_confirmation]', '3n1website');

$I->click('form [type=submit]');
$I->seeCurrentUrlMatches('~^/home$~');
