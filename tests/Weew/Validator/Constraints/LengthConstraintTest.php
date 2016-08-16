<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\LengthConstraint;

class LengthConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new LengthConstraint(5);
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('1'));
        $this->assertFalse($c->check('123'));
        $this->assertFalse($c->check('1234'));
        $this->assertFalse($c->check('123456'));
        $this->assertFalse($c->check([1]));
        $this->assertTrue($c->check('12345'));
        $this->assertTrue($c->check([1, 2, 3, 4, 5]));
    }

    public function test_get_options() {
        $c = new LengthConstraint(10);
        $this->assertEquals(['length' => 10], $c->getOptions());
    }

    public function test_get_message() {
        $c = new LengthConstraint(10, 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new LengthConstraint(10);
        $this->assertNotNull($c->getMessage());
    }
}
