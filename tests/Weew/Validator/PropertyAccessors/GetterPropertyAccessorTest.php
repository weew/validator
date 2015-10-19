<?php

namespace Tests\Weew\Validator\PropertyAccessors;

use PHPUnit_Framework_TestCase;
use stdClass;
use Tests\Weew\Validator\PropertyAccessors\Mocks\TestObject;
use Weew\Validator\PropertyAccessors\GetterPropertyAccessor;

class GetterPropertyAccessorTest extends PHPUnit_Framework_TestCase {
    public function test_supports() {
        $accessor = new GetterPropertyAccessor();
        $this->assertFalse($accessor->supports('foo', 'foo'));
        $this->assertFalse($accessor->supports(1, 'foo'));
        $this->assertFalse($accessor->supports([], 'foo'));
        $this->assertFalse($accessor->supports(new stdClass(), 'foo'));

        $object = new TestObject();

        $this->assertTrue($accessor->supports($object, 'foo'));
        $this->assertTrue($accessor->supports($object, 'bar'));
        $this->assertTrue($accessor->supports($object, 'foobar'));
        $this->assertFalse($accessor->supports($object, 'baz'));
    }

    public function test_get_property() {
        $accessor = new GetterPropertyAccessor();
        $object = new TestObject();

        $this->assertEquals('foo', $accessor->getProperty($object, 'foo'));
        $this->assertEquals('bar', $accessor->getProperty($object, 'bar'));
        $this->assertEquals('foobar', $accessor->getProperty($object, 'foobar'));
    }
}
