<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\IPConstraint;

class IPConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new IPConstraint();
        $this->assertFalse($c->check('192.0.0'));
        $this->assertFalse($c->check('2001:0db8:0000:0042:0000:8a2e:0370'));
        $this->assertTrue($c->check('192.168.0.1'));
        $this->assertTrue($c->check('2001:0db8:0000:0042:0000:8a2e:0370:7334'));
    }

    public function test_get_options() {
        $c = new IPConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new IPConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new IPConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
