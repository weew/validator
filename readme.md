# PHP Validator

[![Build Status](https://img.shields.io/travis/weew/validator.svg)](https://travis-ci.org/weew/validator)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/validator.svg)](https://scrutinizer-ci.com/g/weew/validator)
[![Test Coverage](https://img.shields.io/coveralls/weew/validator.svg)](https://coveralls.io/github/weew/validator)
[![Version](https://img.shields.io/packagist/v/weew/validator.svg)](https://packagist.org/packages/weew/validator)
[![Licence](https://img.shields.io/packagist/l/weew/validator.svg)](https://packagist.org/packages/weew/validator)

## Table of contents

- [Installation](#installation)
- [Available constraints](#available-constraints)
- [Additional constraint packs](#additional-constraint-packs)
- [Constraints](#constraints)
- [Constraint groups](#constraint-groups)
- [Validator](#validator)
- [Validation result and validation errors](#validation-result-and-validation-errors)
- [Composing a custom validator](#composing-a-custom-validator)
- [Creating a custom validator class](#creating-a-custom-validator-class)
- [Custom constraints](#custom-constraints)
- [Wildcard validation](#wildcard-validation)
- [Property accessors](#property-accessors)
    - [Array accessor](#array-accessor)
    - [Object accessor](#object-accessor)
    - [Getter accessor](#getter-accessor)
- [Contributing constraints](#contributing-constraints)

## Installation

`composer require weew/validator`

## Available constraints

- [Accepted](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/AcceptedConstraint.php)
- [Alpha](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/AlphaConstraint.php)
- [AlphaNumeric](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/AlphaNumericConstraint.php)
- [DomainName](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/DomainNameConstraint.php)
- [Email](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/EmailConstraint.php)
- [Equals](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/EqualsConstraint.php)
- [Float](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/FloatConstraint.php)
- [Integer](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/IntegerConstraint.php)
- [IP](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/IPConstraint.php)
- [IPv4](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/IPv4Constraint.php)
- [IPv6](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/IPv6Constraint.php)
- [Length](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/LengthConstraint.php)
- [LengthRange](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/LengthRangeConstraint.php)
- [MacAddress](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/MacAddressConstraint.php)
- [MaxLength](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/MaxLengthConstraint.php)
- [MinLength](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/MinLengthConstraint.php)
- [NotNull](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/NotNullConstraint.php)
- [Null](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/NullConstraint.php)
- [Numeric](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/NumericConstraint.php)
- [Allowed Values](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/AllowedValuesConstraint.php)
- [Not Allowed Values](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/NotAllowedValuesConstraint.php)
- [Value Range](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/ValueRangeConstraint.php)
- [Min Value](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/MinValueConstraint.php)
- [Max Value](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/MaxValueConstraint.php)
- [Regex](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/RegexConstraint.php)
- [String](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/StringConstraint.php)
- [Url](https://github.com/weew/validator/blob/master/src/Weew/Validator/Constraints/UrlConstraint.php)

## Additional constraint packs

There are additional constraints that you may load trough composer.

- [weew/validator-doctrine-constraints](https://github.com/weew/validator-doctrine-constraints)

## Constraints

Constraints are small pieces of validation logic. A constraint can be used on its own, without the validator.

```php
$constraint = new EmailConstraint();
// or
$constraint = new EmailConstraint('Custom error message.');
$check = $constraint->check('foo@bar.baz');

if ($check) {
    // valdiation passed
} else {
    echo $constraint->getMessage();
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
        // $error->getMessage()
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
class ValueRangeConstraint implements IConstraint {
    protected $min;
    protected $max;
    protected $message;

    public function __construct($min, $max, $message = null) {
        $this->min = $min;
        $this->max = $max;
        $this->message = $message;
    }

    public function check($value, IValidationData $data = null) {
        if (is_numeric($value)) {
            return $value >= $this->min && $value <= $this->max;
        }

        return false;
    }

    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Some default error message.';
    }

    public function getOptions() {
        return [
            'min' => $this->min,
            'max' => $this->max,
        ];
    }
}
```

## Wildcard validation

Imagine you have a similar structure that you want to validate.

```php
$input = [
    'items' => [
        ['name' => 'name1'],
        ['name' => null],
        ['name' => 'name3'],
    ],
];
```

In order to validate the `name` property of every single element inside the `items` array, you would have to iterate over the items manually. You could also use a wildcard to target all the values. To wildcard array values, you can use this special character `*`.

```php
$result = $validator->addConstraint('items.*.name', new NotNullConstraint());
```

In the example above, result will hold an error with subject `items.1.name`.

Array keys can also be validated using wildcards. You'll have to use a different wildcard character `#`. Be aware that the `#` wildcard character should always be the last path segment. This is wrong `foo.#.bar`, this is ok `foo.bar.#`.

```php
$input = [
    'items' => [
        'name1' => 'value1',
        '2' => 'value2',
        'name3' => 'value3',
    ],
];

$result = $validator->addConstraint('items.#', new LengthRangeConstraint(3, 5));
```

Result will contain an error with subject `items.1`.

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
