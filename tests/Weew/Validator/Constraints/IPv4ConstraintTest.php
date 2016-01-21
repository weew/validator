<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\IPv4Constraint;

class IPv4ConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new IPv4Constraint();
        $this->assertFalse($c->check('192.0.0'));
        $this->assertTrue($c->check('192.168.0.1'));
    }

    public function test_get_options() {
        $c = new IPv4Constraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new IPv4Constraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new IPv4Constraint();
        $this->assertNotNull($c->getMessage());
    }
}
