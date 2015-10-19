<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\PropertyAccessors\ArrayPropertyAccessor;
use Weew\Validator\Validator;

class ValidatorTest extends PHPUnit_Framework_TestCase {
    public function test_get_and_set_property_accessors() {
        $validator = new Validator();
        $this->assertTrue(is_array($validator->getPropertyAccessors()));
        $this->assertTrue(count($validator->getPropertyAccessors()) > 0);

        $accessors = [new ArrayPropertyAccessor()];
        $validator->setPropertyAccessors($accessors);
        $this->assertTrue($validator->getPropertyAccessors() === $accessors);
    }

    public function test_add_property_accessor() {
        $validator = new Validator();
        $count = count($validator->getPropertyAccessors());
        $accessor = new ArrayPropertyAccessor();
        $validator->addPropertyAccessor($accessor);
        $this->assertEquals($count + 1, count($validator->getPropertyAccessors()));
        $this->assertTrue($validator->getPropertyAccessors()[$count] === $accessor);
    }
}
