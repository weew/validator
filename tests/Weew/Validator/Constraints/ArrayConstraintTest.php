<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use stdClass;
use Weew\Validator\Constraints\ArrayConstraint;

class ArrayConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new ArrayConstraint();
        $this->assertFalse($c->check('foo'));
        $this->assertFalse($c->check(new stdClass()));
        $this->assertTrue($c->check([]));
    }

    public function test_get_options() {
        $c = new ArrayConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new ArrayConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new ArrayConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
