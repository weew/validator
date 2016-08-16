<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\NotEmptyConstraint;

class NotEmptyConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new NotEmptyConstraint();
        $this->assertFalse($c->check(''));
        $this->assertFalse($c->check(false));
        $this->assertFalse($c->check(null));
        $this->assertFalse($c->check(0));
        $this->assertFalse($c->check([]));
        $this->assertTrue($c->check(true));
        $this->assertTrue($c->check(12));
        $this->assertTrue($c->check('foo'));
    }

    public function test_get_options() {
        $c = new NotEmptyConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new NotEmptyConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new NotEmptyConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
