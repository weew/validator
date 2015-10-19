<?php

namespace Tests\Weew\Validator\PropertyAccessors;

use PHPUnit_Framework_TestCase;
use stdClass;
use Weew\Validator\PropertyAccessors\ObjectPropertyAccessor;

class ObjectPropertyAccessorTest extends PHPUnit_Framework_TestCase {
    public function test_supports() {
        $accessor = new ObjectPropertyAccessor();
        $this->assertFalse($accessor->supports('foo'));
        $this->assertFalse($accessor->supports(1));
        $this->assertFalse($accessor->supports([]));
        $this->assertTrue($accessor->supports(new stdClass()));
    }

    public function test_get_property() {
        $accessor = new ObjectPropertyAccessor();
        $object = new stdClass();
        $object->foo = 'bar';
        $object->bar = 'foo';

        $this->assertEquals('bar', $accessor->getProperty($object, 'foo'));
        $this->assertEquals('foo', $accessor->getProperty($object, 'bar'));
        $this->assertNull($accessor->getProperty($object, 'baz'));
    }
}
