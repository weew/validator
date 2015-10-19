<?php

namespace Tests\Weew\Validator\PropertyAccessors;

use PHPUnit_Framework_TestCase;
use stdClass;
use Weew\Validator\PropertyAccessors\ArrayPropertyAccessor;

class ArrayPropertyAccessorTest extends PHPUnit_Framework_TestCase {
    public function test_supports() {
        $accessor = new ArrayPropertyAccessor();
        $this->assertFalse($accessor->supports('foo', 'foo'));
        $this->assertFalse($accessor->supports(1, 'foo'));
        $this->assertFalse($accessor->supports(new stdClass(), 'foo'));
        $this->assertFalse($accessor->supports([], 'foo'));
        $this->assertTrue($accessor->supports(['foo' => 'bar'], 'foo'));

        $data = ['foo' => 'bar', 'bar' => 'foo'];
        $this->assertTrue($accessor->supports($data, 'foo'));
        $this->assertTrue($accessor->supports($data, 'bar'));
        $this->assertFalse($accessor->supports($data, 'baz'));
    }

    public function test_get_property() {
        $data = ['foo' => 'bar', 'bar' => 'foo'];
        $accessor = new ArrayPropertyAccessor();

        $this->assertEquals('bar', $accessor->getProperty($data, 'foo'));
        $this->assertEquals('foo', $accessor->getProperty($data, 'bar'));
    }
}
