# PHP Validator

[![Build Status](https://travis-ci.org/weew/php-validator.svg?branch=master)](https://travis-ci.org/weew/php-validator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/weew/php-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/weew/php-validator/?branch=master)
[![Coverage Status](https://coveralls.io/repos/weew/php-validator/badge.svg?branch=master&service=github)](https://coveralls.io/github/weew/php-validator?branch=master)
[![License](https://poser.pugx.org/weew/php-validator/license)](https://packagist.org/packages/weew/php-validator)

## Table of contents

- [Installation](#installation)
- [Available constraints](#available-constraints)
- [Constraints](#constraints)
- [Constraint groups](#constraint-groups)
- [Validator](#validator)
- [Validation result and validation errors](#validation-result-and-validation-errors)
- [Composing a custom validator](#composing-a-custom-validator)
- [Creating a custom validator class](#creating-a-custom-validator-class)
- [Custom constraints](#custom-constraints)
- [Property accessors](#property-accessors)
    - [Array accessor](#array-accessor)
    - [Object accessor](#object-accessor)
    - [Getter accessor](#getter-accessor)
- [Contributing constraints](#contributing-constraints)

## Installation

`composer require weew/php-validator`

## Available constraints

- [Accepted](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/AcceptedConstraint.php)
- [Allowed](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/AllowedConstraint.php)
- [DomainName](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/DomainNameConstraint.php)
- [Email](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/EmailConstraint.php)
- [Equals](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/EqualsConstraint.php)
- [Float](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/FloatConstraint.php)
- [Integer](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/IntegerConstraint.php)
- [IP](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/IPConstraint.php)
- [IPv4](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/IPv4Constraint.php)
- [IPv6](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/IPv6Constraint.php)
- [Length](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/LengthConstraint.php)
- [LengthRange](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/LengthRangeConstraint.php)
- [MacAddress](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/MacAddressConstraint.php)
- [MaxLength](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/MaxLengthConstraint.php)
- [MinLength](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/MinLengthConstraint.php)
- [Numeric](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/NumericConstraint.php)
- [Regex](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/RegexConstraint.php)
- [String](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/StringConstraint.php)
- [Url](https://github.com/weew/php-validator/blob/master/src/Weew/Validator/Constraints/UrlConstraint.php)

## Constraints

Constraints are small pieces of validation logic. A constraint can be used on its own, without the validator.

```php
$constraint = new EmailConstraint();
$check = $constraint->check('foo@bar.baz');

if ($check) {
    // valdiation passed
} else {
    // validation failed
}
```

## Constraint groups

Constraint groups allows you to configure multiple constraints for a single value.

```php
$group = new ConstraintGroup('email', [
    new EmailConstraint(),
]);
// or
$group = new ConstraintGroup('email');
$group->addConstraint(new EmailConstraint());
```

Constraint groups can be used to validate data without the validator. The ```check``` method returns a ```ValidationResult``` object.

```php
$result = $group->check('foo@bar.baz');
```

## Validator

The easiest way to use the validator is by creating a new instance and adding constraints inline. Validator will return a ```ValidationResult``` object.

```php
$validator = new Validator();
$data = ['username' => 'foo', 'email' => 'foo@bar.baz'];

$result = $validator->check($data, [
    new ConstraintGroup('email', [
        new EmailConstraint(),
    ]),
]);
```

## Validation result and validation errors

Validation result is used to group occurring validation errors. Validation errors hold information about the validated properties, their values and the applied constraints.

```php
if ($result->isFailed()) {
    foreach ($result->getErrors() as $error) {
        // $error->getSubject()
        // $error->getValue()
        // $error->getConstraint()
    }
}
```

## Composing a custom validator

You can compose a validator with predefined constraints that will be applied on each validation.

```php
$data = ['username' => 'foo', 'email' => 'foo@bar.baz'];
$validator->addConstraint('email', new EmailConstraint());
$validator->addConstraints('username', [
    new AlphaConstraint(),
    new LengthRangeConstraint(3, 20),
]);

$result = $validator->check($data);
```

## Creating a custom validator class

Configuring validators inline is not always the best solution. Sometimes you might want to create dedicated validator classes. With this library this is very easy to achieve.

```php
class UserProfileValidator extends Validator {
    protected function configure() {
        $this->addConstraint('email', new EmailConstraint());
        $this->addConstraints('username', [
            new AlphaConstraint(),
            new LengthRangeConstraint(3, 20),
        ]);
    }
}

$data = ['username' => 'foo', 'email' => 'foo@bar.baz'];
$validator = new UserProfileValidator();
$result = $validator->check($data);
```

## Custom constraints

Creating a new constraint is a fairly easy task. All you have to do is to implement the ```IConstraint``` interface. This is an example on how to create a simple constraint that makes sure that a number is within the given range.

```php
class RangeConstraint implements IConstraint {
    protected $min;
    protected $max;

    public function __construct($min, $max) {
        $this->min = $min;
        $this->max = $max;
    }

    public function check($value) {
        if (is_numeric($value)) {
            return $value >= $this->min && $value <= $this->max;
        }

        return false;
    }

    public function toArray() {
        return [
            'min' => $this->min,
            'max' => $this->max,
        ];
    }
}
```

## Property accessors

Validator comes with support for multiple data types.

### Array accessor

This accessor adds support for array based data sets.

```php
$data = ['email' => 'foo@bar.baz'];
$validator->check($data);
```

### Object accessor

This accessor adds support for object based data sets.

```php
$data = new stdClass();
$data->email = 'foo@bar.baz';
$validator->check($data);
```

### Getter accessor

This accessor adds support for objects that only allow to access data over getter methods.

```php
class User {
    protected $username;
    public function __construct($username) {
        $this->username = $username;
    }
    public function getUsername() {
        return $this->username;
    }
}

$validator->check(new User('foo'));
```

## Contributing constraints

- Use one commit for each constraint.
- Each constraint file must have a short description.
- Each constraint must be added to the list of available constraints and linked accordingly.
- Constraints must have a code coverage of 100%.
- Use separate branches or forks to create pull requests.
