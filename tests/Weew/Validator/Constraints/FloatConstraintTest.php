<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\FloatConstraint;

class FloatConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new FloatConstraint();
        $this->assertFalse($c->check('1'));
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('1.2'));
        $this->assertTrue($c->check(1.2));
    }

    public function test_to_array() {
        $c = new FloatConstraint();
        $this->assertEquals([], $c->toArray());
    }
}
