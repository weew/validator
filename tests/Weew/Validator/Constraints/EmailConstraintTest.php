<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\EmailConstraint;

class EmailConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new EmailConstraint();
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('foo'));
        $this->assertFalse($c->check('foo@bar'));
        $this->assertFalse($c->check('foo.com'));
        $this->assertTrue($c->check('foo@bar.com'));
    }

    public function test_to_array() {
        $c = new EmailConstraint();
        $this->assertEquals([], $c->toArray());
    }
}
