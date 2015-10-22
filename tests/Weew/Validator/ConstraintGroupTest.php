<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\ConstraintGroup;
use Weew\Validator\Constraints\EmailConstraint;
use Weew\Validator\Constraints\StringConstraint;

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
}
