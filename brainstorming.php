<?php

//// //// //// //// //// //// //// //// //// //// //// //// //// //// //// ////

// http://laravel.com/docs/5.1/validation#available-validation-rules
// http://symfony.com/doc/current/reference/constraints.html

//// //// //// //// //// //// //// //// //// //// //// //// //// //// //// ////

class LengthConstaint {
    public function __construct($min, $max) {}
}

LengthConstraint
EmailConstraint
AlphaConstraint

class Validator {
    public function __construct() {
        $this->setUp();
    }
}

class UserProfileValidator extends BaseValidator {
    public function setUp() {
        $this->addConstaint('username', [
            new AlphaConstraint(),
            new LengthConstraint(3, 20),
        ]);
    }
}

//// //// //// //// //// //// //// //// //// //// //// //// //// //// //// ////

arrayStrat
objeStart
getterStrat

//// //// //// //// //// //// //// //// //// //// //// //// //// //// //// ////

$validator = new UserProfileValidator();
$result = $validator->validate($data);
$result = $validator->validate(new stdClass());

$result->isOk();
$rulult->isFailed();
$result->getErrors();

//// //// //// //// //// //// //// //// //// //// //// //// //// //// //// ////

$constraint = new LengthConstraint($min, $max);

//// //// //// //// //// //// //// //// //// //// //// //// //// //// //// ////

$validator = new Validator();
$validator->addRule('email', (new EmailConstaint())
    ->restrictTLDs(['com', 'ch'])
    ->setAllowedSpecialCharacters(['-', '_']));

$validator
    ->addRule('email', new AlphaConstraint())
    ->addRule('email', new EmailConstaint());

$validator
    ->addRule('email', [new AlphaConstraint(), new EmailConstaint()]);

//// //// //// //// //// //// //// //// //// //// //// //// //// //// //// ////


$validator->validate($data, [
    'email' => [
        (new EmailConstaint())
            ->restrictTLDs(['com', 'ch'])
            ->setAllowedSpecialCharacters(['-', '_']),

    ]
]);

//// //// //// //// //// //// //// //// //// //// //// //// //// //// //// //// 
