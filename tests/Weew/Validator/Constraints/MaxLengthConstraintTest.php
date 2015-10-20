<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\MaxLengthConstraint;

class MaxLengthConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new MaxLengthConstraint(3);
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('1234'));
        $this->assertFalse($c->check('12345'));
        $this->assertTrue($c->check('123'));
        $this->assertTrue($c->check('12'));
    }

    public function test_to_array() {
        $c = new MaxLengthConstraint(10);
        $this->assertEquals(['max' => 10], $c->toArray());
    }
}
