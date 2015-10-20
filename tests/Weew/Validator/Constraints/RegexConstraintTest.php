<?php

namespace Tests\Weew\Validator\Constraints;

use PHPUnit_Framework_TestCase;
use Weew\Validator\Constraints\RegexConstraint;

class RegexConstraintTest extends PHPUnit_Framework_TestCase {
    public function test_check() {
        $c = new RegexConstraint('/^foo/');
        $this->assertFalse($c->check(1));
        $this->assertFalse($c->check('barfoo'));
        $this->assertTrue($c->check('foobar'));
    }

    public function test_to_array() {
        $c = new RegexConstraint('/foo/');
        $this->assertEquals(['pattern' => '/foo/'], $c->toArray());
    }
}
