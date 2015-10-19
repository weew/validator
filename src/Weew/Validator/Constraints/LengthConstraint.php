<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

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
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        if (is_string($string)) {
            return strlen($string) === $this->length;
        }
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
