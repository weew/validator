<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\NotNullConstraint;

class NotNullConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new NotNullConstraint();
        $this->assertFalse($c->check(null));

        $this->assertTrue($c->check(''));
        $this->assertTrue($c->check(0));
        $this->assertTrue($c->check(10));
        $this->assertTrue($c->check('0'));
        $this->assertTrue($c->check('null'));
    }

    public function test_get_options() {
        $c = new NotNullConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new NotNullConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new NotNullConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
