<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\StringConstraint;
use Weew\Validator\ValidationError;

class ValidationErrorTest extends PHPUnit_Framework_TestCase {
    public function test_getters() {
        $c = new StringConstraint();
        $error = new ValidationError('foo', 'bar', $c);

        $this->assertEquals('foo', $error->getSubject());
        $this->assertEquals('bar', $error->getValue());
        $this->assertEquals($error->getConstraint()->getMessage(), $error->getMessage());
        $this->assertTrue($error->getConstraint() === $c);
    }
}
