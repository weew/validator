<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Weew\Validator\ValidationData;

class ValidationDataTest extends PHPUnit_Framework_TestCase {
    public function test_get() {
        $data = new ValidationData(['foo' => 1]);
        $this->assertEquals(['foo' => 1], $data->get('foo'));
        $this->assertEquals(['bar' => null], $data->get('bar'));
        $this->assertEquals([], $data->get(''));
        $this->assertEquals([], $data->get(null));
    }

    public function test_get_nested() {
        $data = new ValidationData(['foo' => ['bar' => 1]]);
        $this->assertEquals(['foo.bar' => 1], $data->get('foo.bar'));
        $this->assertEquals(['foo.yolo' => null], $data->get('foo.yolo'));
    }

    public function test_get_with_wildcard() {
        $data = new ValidationData([
            'foo' => [
                'bar' => [
                    ['baz' => 1],
                    ['baz' => 2],
                    ['baz' => 3],
                ]
            ],
            'yolo' => [
                'bar' => 4,
                ['baz' => 5],
                'swag' => [
                    'yolo' => ['baz' => 5],
                    ['baz' => 6],
                ],
            ]
        ]);
        $this->assertEquals([
            'foo' => [
                'bar' => [
                    ['baz' => 1],
                    ['baz' => 2],
                    ['baz' => 3],
                ]
            ],
            'yolo' => [
                'bar' => 4,
                ['baz' => 5],
                'swag' => [
                    'yolo' => ['baz' => 5],
                    ['baz' => 6],
                ],
            ]
        ], $data->get('*'));

        $this->assertEquals([
            'foo.bar' => [
                ['baz' => 1],
                ['baz' => 2],
                ['baz' => 3],
            ],
            'yolo.bar' => 4,
        ], $data->get('*.bar'));

        $this->assertEquals([
            'foo.bar.0' => ['baz' => 1],
            'foo.bar.1' => ['baz' => 2],
            'foo.bar.2' => ['baz' => 3],
        ], $data->get('*.bar.*'));

        [
            'foo' => [
                'bar' => [
                    ['baz' => 1],
                    ['baz' => 2],
                    ['baz' => 3],
                ]
            ],
            'yolo' => [
                'bar' => 4,
                ['baz' => 5],
                'swag' => [
                    'yolo' => ['baz' => 5],
                    ['baz' => 6],
                ],
            ]
        ];

        $this->assertEquals([
            'foo.bar.0.baz' => 1,
            'foo.bar.1.baz' => 2,
            'foo.bar.2.baz' => 3,
            'yolo.swag.yolo.baz' => 5,
            'yolo.swag.0.baz' => 6,
        ], $data->get('*.*.*.baz'));
    }
}
