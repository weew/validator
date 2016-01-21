<?php

namespace Tests\Weew\Validator\PropertyAccessors;

use PHPUnit_Framework_TestCase;
use stdClass;
use Tests\Weew\Validator\PropertyAccessors\Mocks\TestObject;
use Weew\Validator\PropertyAccessors\ObjectPropertyAccessor;

class ObjectPropertyAccessorTest extends PHPUnit_Framework_TestCase {
    public function test_supports() {
        $accessor = new ObjectPropertyAccessor();
        $this->assertFalse($accessor->supports('foo', 'foo'));
        $this->assertFalse($accessor->supports(1, 'foo'));
        $this->assertFalse($accessor->supports([], 'foo'));
        $this->assertFalse($accessor->supports(new stdClass(), 'foo'));
        $this->assertTrue($accessor->supports((object) ['foo' => 'bar'], 'foo'));

        $object = (object) ['foo' => 'bar', 'bar' => 'foo'];

        $this->assertTrue($accessor->supports($object, 'foo'));
        $this->assertTrue($accessor->supports($object, 'bar'));
        $this->assertFalse($accessor->supports($object, 'baz'));
    }

    public function test_get_property() {
        $accessor = new ObjectPropertyAccessor();
        $object = (object) ['foo' => 'bar', 'bar' => 'foo'];

        $this->assertEquals('bar', $accessor->getProperty($object, 'foo'));
        $this->assertEquals('foo', $accessor->getProperty($object, 'bar'));
    }

    public function test_get_protected_property() {
        $accessor = new ObjectPropertyAccessor();
        $object = new TestObject();

        $this->assertTrue($accessor->supports($object, 'bar'));
        $this->assertFalse($accessor->supports($object, 'foo'));
    }
}
