<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\AllowedConstraint;

class AllowedConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new AllowedConstraint(true, '1');
        $this->assertFalse($c->check('true'));
        $this->assertFalse($c->check(1));
        $this->assertTrue($c->check(true));
        $this->assertTrue($c->check('1'));
    }

    public function test_to_array() {
        $c = new AllowedConstraint('foo', 'bar');
        $this->assertEquals(['valid_values' => ['foo', 'bar']], $c->toArray());

        $c = new AllowedConstraint(['foo', 'bar']);
        $this->assertEquals(['valid_values' => ['foo', 'bar']], $c->toArray());
    }
}
