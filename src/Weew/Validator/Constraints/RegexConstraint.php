<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value matches given regex pattern.
 */
class RegexConstraint implements IConstraint {
    /**
     * @var string
     */
    private $pattern;

    /**
     * @param $pattern
     */
    public function __construct($pattern) {
        $this->pattern = $pattern;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return preg_match($this->pattern, $value) === 1;
        }

        return false;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'pattern' => $this->pattern,
        ];
    }
}
