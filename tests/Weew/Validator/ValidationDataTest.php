<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\ValidationData;

class ValidationDataTest extends PHPUnit_Framework_TestCase {
    public function test_get() {
        $data = new ValidationData(['foo' => 'bar']);
        $this->assertNull($data->get('bar'));
        $this->assertEquals('foo', $data->get('bar', 'foo'));
        $this->assertEquals('bar', $data->get('foo'));
    }
}
