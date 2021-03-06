<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\ForbiddenConstraint;

class ForbiddenConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new ForbiddenConstraint([true, '1']);
        $this->assertFalse($c->check(true));
        $this->assertFalse($c->check('1'));
        $this->assertTrue($c->check('true'));
        $this->assertTrue($c->check(1));
    }

    public function test_get_options() {
        $c = new ForbiddenConstraint(['foo', 'bar']);
        $this->assertEquals(['forbidden' => ['foo', 'bar']], $c->getOptions());

        $c = new ForbiddenConstraint(['foo', 'bar']);
        $this->assertEquals(['forbidden' => ['foo', 'bar']], $c->getOptions());
    }

    public function test_get_message() {
        $c = new ForbiddenConstraint(['yolo'], 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new ForbiddenConstraint(['yolo']);
        $this->assertNotNull($c->getMessage());
    }
}
