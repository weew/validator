<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Tests\Weew\Validator\Mocks\FailingConstraint;
use Tests\Weew\Validator\Mocks\PassingConstraint;
use Weew\Validator\ConstraintGroup;
use Weew\Validator\Constraints\EmailConstraint;
use Weew\Validator\Constraints\StringConstraint;
use Weew\Validator\IValidationError;

class ConstraintGroupTest extends PHPUnit_Framework_TestCase {
    public function test_get_and_set_name() {
        $g = new ConstraintGroup('foo');
        $this->assertEquals('foo', $g->getName());
        $g->setName('bar');
        $this->assertEquals('bar', $g->getName());
    }

    public function test_get_and_set_constraints() {
        $c1 = [new StringConstraint()];
        $c2 = [new EmailConstraint()];
        $g = new ConstraintGroup('foo', $c1);
        $this->assertTrue($g->getConstraints() === $c1);
        $g->setConstraints($c2);
        $this->assertTrue($g->getConstraints() === $c2);
    }

    public function test_add_constraint() {
        $g = new ConstraintGroup('foo');
        $c = new StringConstraint();
        $this->assertTrue($g->getConstraints() === []);
        $g->addConstraint($c);
        $this->assertTrue($g->getConstraints() === [$c]);
    }

    public function test_add_constraints() {
        $c1 = [new StringConstraint(), new EmailConstraint()];
        $c2 = [new StringConstraint(), new EmailConstraint()];
        $g = new ConstraintGroup('foo', $c1);
        $g->addConstraints($c2);
        $this->assertTrue($g->getConstraints() === array_merge($c1, $c2));
    }

    public function test_extend() {
        $c1 = new StringConstraint();
        $c2 = new EmailConstraint();
        $g1 = new ConstraintGroup('foo', [$c1, $c2]);
        $g2 = new ConstraintGroup('bar', [$c2, $c1]);

        $g1->extend($g2);
        $this->assertEquals('foo', $g1->getName());
        $this->assertEquals([$c1, $c2, $c2, $c1], $g1->getConstraints());
    }

    public function test_check() {
        $g = new ConstraintGroup('foo');
        $c1 = new PassingConstraint();
        $c2 = new FailingConstraint();
        $this->assertTrue($g->check('bar')->isOk());
        $g->addConstraint($c1);
        $this->assertTrue($g->check('bar')->isOk());
        $g->addConstraint($c1);
        $this->assertTrue($g->check('bar')->isOk());
        $g->addConstraint($c2);
        $this->assertTrue($g->check('bar')->isFailed());
        $result = $g->check('bar');
        $this->assertEquals(1, count($result->getErrors()));
        $error = $result->getErrors()[0];
        $this->assertTrue($error instanceof IValidationError);
        $this->assertEquals('foo', $error->getSubject());
        $this->assertEquals('bar', $error->getValue());
        $this->assertTrue($error->getConstraint() === $c2);
    }
}
