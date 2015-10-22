<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\PropertyAccessors\ArrayPropertyAccessor;
use Weew\Validator\PropertyReader;

class PropertyReaderTest extends PHPUnit_Framework_TestCase {
    public function test_get_and_set_property_accessors() {
        $reader = new PropertyReader();
        $this->assertTrue(is_array($reader->getPropertyAccessors()));
        $this->assertTrue(count($reader->getPropertyAccessors()) > 0);

        $accessors = [new ArrayPropertyAccessor()];
        $reader->setPropertyAccessors($accessors);
        $this->assertTrue($reader->getPropertyAccessors() === $accessors);
    }

    public function test_add_property_accessor() {
        $reader = new PropertyReader();
        $count = count($reader->getPropertyAccessors());
        $accessor = new ArrayPropertyAccessor();
        $reader->addPropertyAccessor($accessor);
        $this->assertEquals($count + 1, count($reader->getPropertyAccessors()));
        $this->assertTrue($reader->getPropertyAccessors()[$count] === $accessor);
    }

    public function test_get_property() {
        $reader = new PropertyReader();
        $this->assertEquals('bar', $reader->getProperty(['foo' => 'bar'], 'foo'));
        $this->assertNull($reader->getProperty([], 'foo'));
    }
}
