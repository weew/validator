<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\NullableConstraint;

class NullableConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new NullableConstraint();
        $this->assertFalse($c->check(''));
        $this->assertFalse($c->check(null));
        $this->assertTrue($c->check('foo'));
        $this->assertTrue($c->check(22));
    }

    public function test_get_options() {
        $c = new NullableConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new NullableConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new NullableConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
