<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\MinConstraint;

class MinConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new MinConstraint(1);
        $this->assertFalse($c->check(0));
        $this->assertFalse($c->check(-1));
        $this->assertFalse($c->check('-1'));
        $this->assertFalse($c->check('a'));

        $this->assertTrue($c->check('10'));
        $this->assertTrue($c->check('010'));
        $this->assertTrue($c->check(5));
        $this->assertTrue($c->check('5'));
    }

    public function test_get_options() {
        $c = new MinConstraint(1);
        $this->assertEquals(['min' => 1], $c->getOptions());
    }

    public function test_get_message() {
        $c = new MinConstraint(1, 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new MinConstraint(1);
        $this->assertNotNull($c->getMessage());
    }
}
