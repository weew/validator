<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\MacAddressConstraint;

class MacAddressConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new MacAddressConstraint();
        $this->assertFalse($c->check('foo'));
        $this->assertFalse($c->check('01:23:45:67:89'));
        $this->assertTrue($c->check('01:23:45:67:89:ab'));
    }

    public function test_to_array() {
        $c = new MacAddressConstraint();
        $this->assertEquals([], $c->toArray());
    }
}
