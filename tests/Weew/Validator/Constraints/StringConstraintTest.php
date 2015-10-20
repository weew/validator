<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use stdClass;
use Weew\Validator\Constraints\StringConstraint;

class StringConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new StringConstraint();
        $this->assertFalse($c->check(123));
        $this->assertFalse($c->check([]));
        $this->assertFalse($c->check(new stdClass()));
        $this->assertTrue($c->check('123'));
        $this->assertTrue($c->check('foo'));
    }

    public function test_to_array() {
        $c = new StringConstraint();
        $this->assertEquals([], $c->toArray());
    }
}
