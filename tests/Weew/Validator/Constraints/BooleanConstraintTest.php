<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\BooleanConstraint;

class BooleanConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new BooleanConstraint();
        $this->assertFalse($c->check('foo'));
        $this->assertFalse($c->check(1));
        $this->assertTrue($c->check(true));
        $this->assertTrue($c->check(false));
    }

    public function test_get_options() {
        $c = new BooleanConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new BooleanConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new BooleanConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
