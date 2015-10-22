<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\StringConstraint;
use Weew\Validator\ValidationError;
use Weew\Validator\ValidationResult;

class ValidationResultTest extends PHPUnit_Framework_TestCase {
    public function test_add_error() {
        $result = new ValidationResult();
        $error = new ValidationError('foo', 'bar', new StringConstraint());
        $result->addError($error);
        $this->assertTrue($result->getErrors() === [$error]);
        $result->addError($error);
        $this->assertTrue($result->getErrors() === [$error, $error]);
    }

    public function test_add_errors() {
        $result = new ValidationResult();
        $error = new ValidationError('foo', 'bar', new StringConstraint());
        $result->addErrors([$error, $error]);
        $this->assertTrue($result->getErrors() === [$error, $error]);
        $result->addErrors([$error, $error]);
        $this->assertTrue($result->getErrors() === [$error, $error, $error, $error]);
    }

    public function test_error_count() {
        $result = new ValidationResult();
        $error = new ValidationError('foo', 'bar', new StringConstraint());
        $this->assertEquals(0, $result->errorCount());
        $result->addError($error);
        $this->assertEquals(1, $result->errorCount());
        $result->addError($error);
        $this->assertEquals(2, $result->errorCount());
    }

    public function test_is_ok() {
        $result = new ValidationResult();
        $error = new ValidationError('foo', 'bar', new StringConstraint());
        $this->assertTrue($result->isOk());
        $result->addError($error);
        $this->assertFalse($result->isOk());
    }

    public function test_is_failed() {
        $result = new ValidationResult();
        $error = new ValidationError('foo', 'bar', new StringConstraint());
        $this->assertFalse($result->isFailed());
        $result->addError($error);
        $this->assertTrue($result->isFailed());
    }
}
