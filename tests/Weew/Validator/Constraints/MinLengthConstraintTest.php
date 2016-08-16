<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\MinLengthConstraint;

class MinLengthConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new MinLengthConstraint(3);
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('12'));
        $this->assertFalse($c->check([1, 2]));
        $this->assertTrue($c->check('123'));
        $this->assertTrue($c->check('1234'));
        $this->assertTrue($c->check('12345'));
        $this->assertTrue($c->check([1, 2, 3]));
    }

    public function test_get_options() {
        $c = new MinLengthConstraint(10);
        $this->assertEquals(['min' => 10], $c->getOptions());
    }

    public function test_get_message() {
        $c = new MinLengthConstraint(10, 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new MinLengthConstraint(10);
        $this->assertNotNull($c->getMessage());
    }
}
