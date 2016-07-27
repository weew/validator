<?php

namespace Tests\Weew\Validator\Mocks;

use Weew\Contracts\IArrayable;

class ArrayableDict implements IArrayable {
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function toArray() {
        return $this->data;
    }
}
