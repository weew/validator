<?php

namespace Tests\Weew\Validator\PropertyAccessors\Mocks;

class TestObject {
    public function getFoo() {
        return 'foo';
    }

    public function getBar() {
        return 'bar';
    }

    public function getFooBar() {
        return 'foobar';
    }
}
