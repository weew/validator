<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\AlphaNumericConstraint;

class AlphaNumericConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new AlphaNumericConstraint();
        $this->assertFalse($c->check('-'));
        $this->assertFalse($c->check('a.b'));
        $this->assertFalse($c->check('1+3a'));
        $this->assertFalse($c->check(''));
        $this->assertFalse($c->check(' '));
        $this->assertFalse($c->check([]));

        $this->assertTrue($c->check(123));
        $this->assertTrue($c->check('123'));
        $this->assertTrue($c->check('foo'));
        $this->assertTrue($c->check('foo123'));
    }

    public function test_to_array() {
        $c = new AlphaNumericConstraint();
        $this->assertEquals([], $c->toArray());
    }
}
