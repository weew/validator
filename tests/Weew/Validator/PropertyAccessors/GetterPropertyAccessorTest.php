<?php

namespace Tests\Weew\Validator\PropertyAccessors;

use PHPUnit_Framework_TestCase;
use stdClass;
use Tests\Weew\Validator\PropertyAccessors\Mocks\TestObject;
use Weew\Validator\PropertyAccessors\GetterPropertyAccessor;

class GetterPropertyAccessorTest extends PHPUnit_Framework_TestCase {
    public function test_supports() {
        $accessor = new GetterPropertyAccessor();
        $this->assertFalse($accessor->supports('foo'));
        $this->assertFalse($accessor->supports(1));
        $this->assertFalse($accessor->supports([]));
        $this->assertTrue($accessor->supports(new stdClass()));
    }

    public function test_get_property() {
        $accessor = new GetterPropertyAccessor();
        $object = new TestObject();

        $this->assertEquals('foo', $accessor->getProperty($object, 'foo'));
        $this->assertEquals('bar', $accessor->getProperty($object, 'bar'));
        $this->assertEquals('foobar', $accessor->getProperty($object, 'foobar'));
        $this->assertNull($accessor->getProperty($object, 'baz'));
    }
}
