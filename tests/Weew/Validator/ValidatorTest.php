<?php

namespace Tests\Weew\Validator;

use Exception;
use PHPUnit_Framework_TestCase;
use Tests\Weew\Validator\Mocks\CustomValidator;
use Tests\Weew\Validator\Mocks\FailingConstraint;
use Tests\Weew\Validator\Mocks\PassingConstraint;
use Weew\Validator\ConstraintGroup;
use Weew\Validator\Constraints\EmailConstraint;
use Weew\Validator\Constraints\StringConstraint;
use Weew\Validator\IPropertyReader;
use Weew\Validator\IValidationResult;
use Weew\Validator\PropertyReader;
use Weew\Validator\Validator;

class ValidatorTest extends PHPUnit_Framework_TestCase {
    public function test_get_property_reader() {
        $validator = new Validator();
        $this->assertTrue($validator->getPropertyReader() instanceof IPropertyReader);
    }

    public function test_construct_with_property_reader() {
        $reader = new PropertyReader();
        $validator = new Validator($reader);
        $this->assertTrue($validator->getPropertyReader() === $reader);
    }

    public function test_add_constraint_group() {
        $validator = new Validator();
        $c1 = new StringConstraint();
        $c2 = new EmailConstraint();
        $g1 = new ConstraintGroup('foo', [$c1]);
        $g2 = new ConstraintGroup('foo', [$c2]);

        $this->assertEquals([], $validator->getConstraintGroups());
        $validator->addConstraintGroup($g1);
        $this->assertEquals([$g1], $validator->getConstraintGroups());
        $this->assertEquals([$c1], $g1->getConstraints());
        $return = $validator->addConstraintGroup($g2);
        $this->assertEquals([$g1], $validator->getConstraintGroups());
        $this->assertEquals([$c1, $c2], $g1->getConstraints());
        $this->assertTrue($return === $validator);
    }

    public function test_add_constraint() {
        $validator = new Validator();
        $c1 = new StringConstraint();
        $c2 = new EmailConstraint();
        $this->assertEquals(0, count($validator->getConstraintGroups()));
        $validator->addConstraint('foo', $c1);
        $this->assertEquals(1, count($validator->getConstraintGroups()));
        $this->assertEquals('foo', $validator->getConstraintGroups()[0]->getName());
        $this->assertEquals([$c1], $validator->getConstraintGroups()[0]->getConstraints());
        $validator->addConstraint('foo', $c2);
        $this->assertEquals(1, count($validator->getConstraintGroups()));
        $this->assertEquals([$c1, $c2], $validator->getConstraintGroups()[0]->getConstraints());
        $return = $validator->addConstraint('bar', $c1);
        $this->assertEquals(2, count($validator->getConstraintGroups()));
        $this->assertEquals('bar', $validator->getConstraintGroups()[1]->getName());
        $this->assertEquals([$c1], $validator->getConstraintGroups()[1]->getConstraints());
        $this->assertTrue($return === $validator);
    }

    public function test_add_constraints() {
        $validator = new Validator();
        $c1 = new StringConstraint();
        $c2 = new EmailConstraint();
        $this->assertEquals(0, count($validator->getConstraintGroups()));
        $validator->addConstraints('foo', [$c1]);
        $this->assertEquals(1, count($validator->getConstraintGroups()));
        $this->assertEquals('foo', $validator->getConstraintGroups()[0]->getName());
        $validator->addConstraints('foo', [$c1, $c2]);
        $this->assertEquals(1, count($validator->getConstraintGroups()));
        $this->assertEquals([$c1, $c1, $c2], $validator->getConstraintGroups()[0]->getConstraints());
        $return = $validator->addConstraints('bar', [$c1, $c2]);
        $this->assertEquals(2, count($validator->getConstraintGroups()));
        $this->assertEquals('bar', $validator->getConstraintGroups()[1]->getName());
        $this->assertEquals([$c1, $c2], $validator->getConstraintGroups()[1]->getConstraints());
        $this->assertTrue($return === $validator);
    }

    public function test_check() {
        $data = ['foo' => 'bar', 'bar' => 'foo'];
        $validator = new Validator();

        $validator->addConstraint('foo', new PassingConstraint());
        $result = $validator->check($data);
        $this->assertTrue($result instanceof IValidationResult);
        $this->assertTrue($result->isOk());

        $validator->addConstraint('foo', new FailingConstraint());
        $result = $validator->check($data);
        $this->assertTrue($result->isFailed());

        $this->assertEquals(1, $result->errorCount());
        $errors = $result->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];
        $this->assertEquals('foo', $error->getSubject());
        $this->assertEquals('bar', $error->getValue());
        $this->assertTrue($error->getConstraint() instanceof FailingConstraint);
    }

    public function test_validator_accepts_inline_constraints() {
        return;
        $data = ['foo' => 'bar', 'bar' => 'foo'];
        $validator = new Validator();

        $validator->addConstraint('foo', new PassingConstraint());
        $result = $validator->check($data, [new ConstraintGroup('foo', [new FailingConstraint()])]);
        $this->assertTrue($result->isFailed());

        $validator = new Validator();
        $validator->addConstraint('foo', new FailingConstraint());
        $result = $validator->check($data, [new ConstraintGroup('foo', [new PassingConstraint()])]);
        $this->assertTrue($result->isFailed());
        $this->assertEquals(1, $result->errorCount());
        $error = $result->getErrors()[0];
        $this->assertTrue($error instanceof FailingConstraint);
        $this->assertEquals('foo', $error->getSubject());;
    }

    public function test_validator_calls_configure_method() {
        $this->setExpectedException(Exception::class, 'foo bar baz');
        new CustomValidator();
    }
}
