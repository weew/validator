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
     * @param $string
     *
     * @return bool
     */
    public function check($string) {
        if (is_string($string)) {
            return preg_match($this->pattern, $string) === 1;
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
