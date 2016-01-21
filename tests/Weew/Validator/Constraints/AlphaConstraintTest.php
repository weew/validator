<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\AlphaConstraint;

class AlphaConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new AlphaConstraint();
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check(''));
        $this->assertFalse($c->check(' '));
        $this->assertFalse($c->check('-'));
        $this->assertFalse($c->check('1'));
        $this->assertFalse($c->check('foo2bar'));

        $this->assertTrue($c->check('a'));
        $this->assertTrue($c->check('A'));
    }

    public function test_get_options() {
        $c = new AlphaConstraint();
        $this->assertEquals([], $c->getOptions());
    }

    public function test_get_message() {
        $c = new AlphaConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new AlphaConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
