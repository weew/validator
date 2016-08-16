<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use stdClass;
use Weew\Validator\Constraints\ScalarConstraint;

class ScalarConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new ScalarConstraint();
        $this->assertFalse($c->check([]));
        $this->assertFalse($c->check(new stdClass()));
        $this->assertTrue($c->check(1));
        $this->assertTrue($c->check('foo'));
        $this->assertTrue($c->check(true));
    }

    public function test_get_options() {
        $c = new ScalarConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new ScalarConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new ScalarConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
