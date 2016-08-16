<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\ValueRangeConstraint;

class ValueRangeConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new ValueRangeConstraint(0, 9);
        $this->assertFalse($c->check(-1));
        $this->assertFalse($c->check('-1'));
        $this->assertFalse($c->check(10));
        $this->assertFalse($c->check('10'));
        $this->assertFalse($c->check('010'));
        $this->assertFalse($c->check('a'));

        $this->assertTrue($c->check(5));
        $this->assertTrue($c->check('5'));
    }

    public function test_get_options() {
        $c = new ValueRangeConstraint(2, 5);
        $this->assertEquals(['min' => 2, 'max' => 5], $c->getOptions());
    }

    public function test_get_message() {
        $c = new ValueRangeConstraint(10, 20, 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new ValueRangeConstraint(10, 20);
        $this->assertNotNull($c->getMessage());
    }
}
