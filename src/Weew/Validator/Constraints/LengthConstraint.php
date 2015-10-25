<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value has exactly the given length.
 */
class LengthConstraint implements IConstraint {
    /**
     * @var int
     */
    protected $length;

    /**
     * @param $length
     */
    public function __construct($length) {
        $this->length = $length;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return strlen($value) === $this->length;
        }

        return false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'length' => $this->length,
        ];
    }
}
