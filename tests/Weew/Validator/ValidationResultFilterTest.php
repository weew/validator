<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\Constraints\NullableConstraint;
use Weew\Validator\ValidationError;
use Weew\Validator\ValidationResult;
use Weew\Validator\ValidationResultFilter;

class ValidationResultFilterTest extends PHPUnit_Framework_TestCase {
    public function test_removes_nullable_errors() {
        $error1 = new ValidationError('foo.bar.baz', 'baz', new NotNullConstraint());
        $error2 = new ValidationError('foo.bar.yolo', 'baz', new NotNullConstraint());
        $error3 = new ValidationError('some.value', 'baz', new NotNullConstraint());
        $error4 = new ValidationError('another.value', 'baz', new NotNullConstraint());
        $error5 = new ValidationError('foo.bar', 'baz', new NullableConstraint());
        $error6 = new ValidationError('foo', 'baz', new NotNullConstraint());
        $errors = [$error1, $error2, $error3, $error4, $error5, $error6];

        $result = new ValidationResult($errors);
        $filter = new ValidationResultFilter();
        $filteredResult = $filter->removeNullableErrors($result);

        $this->assertEquals(3, $filteredResult->getErrorCount());
        $this->assertTrue($filteredResult->getErrors()[0] === $error3);
        $this->assertTrue($filteredResult->getErrors()[1] === $error4);
        $this->assertTrue($filteredResult->getErrors()[2] === $error6);
    }
}
