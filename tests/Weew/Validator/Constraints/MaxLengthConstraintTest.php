<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\MaxLengthConstraint;

class MaxLengthConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new MaxLengthConstraint(3);
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('1234'));
        $this->assertFalse($c->check('12345'));
        $this->assertFalse($c->check([1, 2, 3, 4]));
        $this->assertTrue($c->check('123'));
        $this->assertTrue($c->check('12'));
        $this->assertTrue($c->check([1, 2, 3]));
        $this->assertTrue($c->check([1, 2]));
    }

    public function test_get_options() {
        $c = new MaxLengthConstraint(10);
        $this->assertEquals(['max' => 10], $c->getOptions());
    }

    public function test_get_message() {
        $c = new MaxLengthConstraint(10, 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new MaxLengthConstraint(10);
        $this->assertNotNull($c->getMessage());
    }
}
