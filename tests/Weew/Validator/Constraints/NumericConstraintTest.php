<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\NumericConstraint;

class NumericConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new NumericConstraint();
        $this->assertFalse($c->check('foo'));
        $this->assertFalse($c->check('foo2'));
        $this->assertFalse($c->check('2foo'));
        $this->assertTrue($c->check(1));
        $this->assertTrue($c->check(1.2));
        $this->assertTrue($c->check('1'));
        $this->assertTrue($c->check('1.2'));
    }

    public function test_to_array() {
        $c = new NumericConstraint();
        $this->assertEquals([], $c->toArray());
    }
}
