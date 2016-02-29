<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\IntegerConstraint;
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

    public function test_extend() {
        $r1 = new ValidationResult();
        $r2 = new ValidationResult();
        $r3 = new ValidationResult();

        $e1 = new ValidationError('foo', 'bar', new StringConstraint());
        $e2 = new ValidationError('bar', 'foo', new StringConstraint());
        $e3 = new ValidationError('baz', 'bar', new StringConstraint());

        $r1->addErrors([$e1, $e2]);
        $r2->addError($e2);
        $r3->addError($e3);

        $this->assertEquals([$e1, $e2], $r1->getErrors());
        $r1->extend($r2);
        $this->assertEquals([$e1, $e2, $e2], $r1->getErrors());
        $r1->extend($r3);
        $this->assertEquals([$e1, $e2, $e2, $e3], $r1->getErrors());
    }

    public function test_to_array() {
        $result = new ValidationResult();
        $result->addErrors([
            new ValidationError('foo', '', new StringConstraint()),
            new ValidationError('bar', '', new IntegerConstraint()),
        ]);

        $this->assertEquals(
            [
                'foo' => [(new StringConstraint())->getMessage()],
                'bar' => [(new IntegerConstraint())->getMessage()],
            ], $result->toArray()
        );
    }

    public function test_to_array_multiple() {
        $result = new ValidationResult();
        $result->addErrors([
            new ValidationError('foo', '', new StringConstraint()),
            new ValidationError('foo', '', new IntegerConstraint()),
        ]);

        $this->assertEquals(
            [
                'foo' => [
                    (new StringConstraint())->getMessage(),
                    (new IntegerConstraint())->getMessage()
                ],
            ], $result->toArray()
        );
    }
}
