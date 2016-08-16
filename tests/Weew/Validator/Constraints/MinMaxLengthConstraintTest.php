<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\MinMaxLengthConstraint;

class MinMaxLengthConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new MinMaxLengthConstraint(3, 5);
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('12'));
        $this->assertFalse($c->check('123456'));
        $this->assertTrue($c->check('123'));
        $this->assertTrue($c->check('1234'));
        $this->assertTrue($c->check('12345'));
    }
    public function test_get_options() {
        $c = new MinMaxLengthConstraint(10, 20);
        $this->assertEquals(['min' => 10, 'max' => 20], $c->getOptions());
    }

    public function test_get_message() {
        $c = new MinMaxLengthConstraint(10, 20, 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new MinMaxLengthConstraint(10, 20);
        $this->assertNotNull($c->getMessage());
    }
}
