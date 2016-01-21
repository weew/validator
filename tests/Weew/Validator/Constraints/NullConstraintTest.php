<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\NullConstraint;

class NullConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new NullConstraint();
        $this->assertFalse($c->check(''));
        $this->assertFalse($c->check(0));
        $this->assertFalse($c->check('0'));
        $this->assertFalse($c->check('null'));

        $this->assertTrue($c->check(null));
    }

    public function test_get_options() {
        $c = new NullConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new NullConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new NullConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
