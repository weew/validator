<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\LengthRangeConstraint;

class LengthRangeConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new LengthRangeConstraint(3, 5);
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('12'));
        $this->assertFalse($c->check('123456'));
        $this->assertTrue($c->check('123'));
        $this->assertTrue($c->check('1234'));
        $this->assertTrue($c->check('12345'));
    }
    public function test_get_options() {
        $c = new LengthRangeConstraint(10, 20);
        $this->assertEquals(['min' => 10, 'max' => 20], $c->getOptions());
    }

    public function test_get_message() {
        $c = new LengthRangeConstraint(10, 20, 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new LengthRangeConstraint(10, 20);
        $this->assertNotNull($c->getMessage());
    }
}
