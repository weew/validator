<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\AcceptedConstraint;

class AcceptedConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new AcceptedConstraint();
        $this->assertFalse($c->check('foo'));
        $this->assertFalse($c->check(22));
        $this->assertFalse($c->check(false));
        $this->assertTrue($c->check('yes'));
        $this->assertTrue($c->check('on'));
        $this->assertTrue($c->check('1'));
        $this->assertTrue($c->check('true'));
        $this->assertTrue($c->check(1));
        $this->assertTrue($c->check(true));
    }

    public function test_get_options() {
        $c = new AcceptedConstraint();
        $this->assertEquals([
            'valid_values' => ['yes', 'on', '1', 'true', 1, true],
        ], $c->getOptions());
    }

    public function test_get_message() {
        $c = new AcceptedConstraint('foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new AcceptedConstraint();
        $this->assertNotNull($c->getMessage());
    }
}
