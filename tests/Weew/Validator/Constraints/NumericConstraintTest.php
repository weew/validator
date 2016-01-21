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

    public function test_get_options() {
        $c = new NumericConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new NumericConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new NumericConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
