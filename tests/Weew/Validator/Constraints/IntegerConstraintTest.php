<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\IntegerConstraint;

class IntegerConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new IntegerConstraint();
        $this->assertFalse($c->check(1.2));
        $this->assertFalse($c->check('1.2'));
        $this->assertFalse($c->check('1'));
        $this->assertTrue($c->check(1));
        $this->assertTrue($c->check(123));
    }

    public function test_get_options() {
        $c = new IntegerConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new IntegerConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new IntegerConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
