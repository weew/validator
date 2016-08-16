<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\AllowedValuesConstraint;

class AllowedValuesConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new AllowedValuesConstraint([true, '1']);
        $this->assertFalse($c->check('true'));
        $this->assertFalse($c->check(1));
        $this->assertTrue($c->check(true));
        $this->assertTrue($c->check('1'));
    }

    public function test_get_options() {
        $c = new AllowedValuesConstraint(['foo', 'bar']);
        $this->assertEquals(['allowed_values' => ['foo', 'bar']], $c->getOptions());

        $c = new AllowedValuesConstraint(['foo', 'bar']);
        $this->assertEquals(['allowed_values' => ['foo', 'bar']], $c->getOptions());
    }

    public function test_get_message() {
        $c = new AllowedValuesConstraint(['yolo'], 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new AllowedValuesConstraint(['yolo']);
        $this->assertNotNull($c->getMessage());
    }
}
