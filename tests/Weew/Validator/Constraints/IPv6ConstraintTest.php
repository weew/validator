<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\IPv6Constraint;

class IPv6ConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new IPv6Constraint();
        $this->assertFalse($c->check('2001:0db8:0000:0042:0000:8a2e:0370'));
        $this->assertTrue($c->check('2001:0db8:0000:0042:0000:8a2e:0370:7334'));
    }

    public function test_get_options() {
        $c = new IPv6Constraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new IPv6Constraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new IPv6Constraint();
        $this->assertNotNull($c->getMessage());
    }
}
