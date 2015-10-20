<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

class EqualsConstraint implements IConstraint {
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param $value
     */
    public function __construct($value) {
        $this->value = $value;
    }

    /**
     * @param $abstract
     *
     * @return bool
     */
    public function check($abstract) {
        return $abstract === $this->value;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'value' => $this->value,
        ];
    }
}
