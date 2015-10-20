<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\EqualsConstraint;

class EqualsConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new EqualsConstraint('true');
        $this->assertFalse($c->check('foo'));
        $this->assertFalse($c->check(true));
        $this->assertTrue($c->check('true'));
    }

    public function test_to_array() {
        $c = new EqualsConstraint('foo');
        $this->assertEquals(['value' => 'foo'], $c->toArray());
    }
}
