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

    public function test_get_options() {
        $c = new RegexConstraint('/foo/');
        $this->assertEquals(['pattern' => '/foo/'], $c->getOptions());
    }

    public function test_get_message() {
        $c = new RegexConstraint('/^foo/', 'foo');
        $this->assertEquals('foo', $c->getMessage());

        $c = new RegexConstraint('/^foo/');
        $this->assertNotNull($c->getMessage());
    }
}
