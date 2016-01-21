<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is numeric (123 or '123').
 */
class NumericConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * NumericConstraint constructor.
     *
     * @param string $message
     */
    public function __construct($message = null) {
        $this->message = $message;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        return is_numeric($value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must consist of numeric characters.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
