<?php

namespace Tests\Weew\Validator;

use PHPUnit_Framework_TestCase;
use Tests\Weew\Validator\Mocks\ArrayableDict;
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

    public function test_get_wildcard_values() {
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
                    'bam' => ['baz' => null],
                    'bang' => [],
                    'bong' => 'baz',
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
                    'bam' => ['baz' => null],
                    'bang' => [],
                    'bong' => 'baz',
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

        $this->assertEquals([
            'foo.bar.0.baz' => 1,
            'foo.bar.1.baz' => 2,
            'foo.bar.2.baz' => 3,
            'yolo.swag.yolo.baz' => 5,
            'yolo.swag.0.baz' => 6,
            'yolo.swag.bam.baz' => null,
            'yolo.swag.bang.baz' => null,
        ], $data->get('*.*.*.baz'));
    }

    public function test_get_wildcard_keys() {
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
            'foo.bar' => 'bar',
        ], $data->get('foo.#'));

        $this->assertEquals([
            'foo.bar' => 'bar',
        ], $data->get('foo.#.0'));

        $this->assertEquals([
            'foo.bar' => 'bar',
            'yolo.bar' => 'bar',
            'yolo.0' => 0,
            'yolo.swag' => 'swag',
        ], $data->get('*.#'));
    }

    public function test_get_from_non_arrays() {
        $data = new ValidationData([
            'foo' => new ArrayableDict([
                ['bar' => null],
                ['bar' => 1],
                ['bar' => null]
            ]),
            'bar' => null,
            'yolo' => 'swag',
        ]);

        $this->assertEquals([
            'foo.0.bar' => null,
            'foo.1.bar' => 1,
            'foo.2.bar' => null,
        ], $data->get('foo.*.bar'));

        $this->assertEquals([
            'foo.0' => '0',
            'foo.1' => '1',
            'foo.2' => '2',
        ], $data->get('foo.#'));

        $this->assertEquals([], $data->get('foo.bar.#'));
    }
}
