<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\NotAllowedValuesConstraint;

class NotAllowedValuesConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new NotAllowedValuesConstraint([true, '1']);
        $this->assertFalse($c->check(true));
        $this->assertFalse($c->check('1'));
        $this->assertTrue($c->check('true'));
        $this->assertTrue($c->check(1));
    }

    public function test_get_options() {
        $c = new NotAllowedValuesConstraint(['foo', 'bar']);
        $this->assertEquals(['not_allowed_values' => ['foo', 'bar']], $c->getOptions());

        $c = new NotAllowedValuesConstraint(['foo', 'bar']);
        $this->assertEquals(['not_allowed_values' => ['foo', 'bar']], $c->getOptions());
    }

    public function test_get_message() {
        $c = new NotAllowedValuesConstraint(['yolo'], 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new NotAllowedValuesConstraint(['yolo']);
        $this->assertNotNull($c->getMessage());
    }
}
