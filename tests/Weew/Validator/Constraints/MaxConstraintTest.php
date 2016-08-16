<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\MaxConstraint;

class MaxConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new MaxConstraint(5);
        $this->assertFalse($c->check(6));
        $this->assertFalse($c->check(10));
        $this->assertFalse($c->check('10'));
        $this->assertFalse($c->check('010'));
        $this->assertFalse($c->check('a'));

        $this->assertTrue($c->check('-1'));
        $this->assertTrue($c->check(5));
        $this->assertTrue($c->check('5'));
        $this->assertTrue($c->check(4));
    }

    public function test_get_options() {
        $c = new MaxConstraint(1);
        $this->assertEquals(['max' => 1], $c->getOptions());
    }

    public function test_get_message() {
        $c = new MaxConstraint(1, 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new MaxConstraint(1);
        $this->assertNotNull($c->getMessage());
    }
}
