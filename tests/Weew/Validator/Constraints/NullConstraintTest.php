<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\NullConstraint;

class NullConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new NullConstraint();
        $this->assertFalse($c->check(""));
        $this->assertFalse($c->check(0));
        $this->assertFalse($c->check("0"));
        $this->assertFalse($c->check("null"));

        $this->assertTrue($c->check(null));
    }

    public function test_to_array() {
        $c = new NullConstraint();
        $this->assertEquals([], $c->toArray());
    }
}
