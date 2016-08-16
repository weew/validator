<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\AllowedSubsetConstraint;

class AllowedSubsetConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new AllowedSubsetConstraint([true, '1']);
        $this->assertFalse($c->check('true'));
        $this->assertFalse($c->check(true));
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('1'));
        $this->assertFalse($c->check(['true']));
        $this->assertFalse($c->check(['true', 1]));
        $this->assertTrue($c->check([true]));
        $this->assertTrue($c->check(['1']));
        $this->assertTrue($c->check([true]));
        $this->assertTrue($c->check([true, '1']));
    }

    public function test_get_options() {
        $c = new AllowedSubsetConstraint(['foo', 'bar']);
        $this->assertEquals(['allowed' => ['foo', 'bar']], $c->getOptions());

        $c = new AllowedSubsetConstraint(['foo', 'bar']);
        $this->assertEquals(['allowed' => ['foo', 'bar']], $c->getOptions());
    }

    public function test_get_message() {
        $c = new AllowedSubsetConstraint(['yolo'], 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new AllowedSubsetConstraint(['yolo']);
        $this->assertNotNull($c->getMessage());
    }
}
