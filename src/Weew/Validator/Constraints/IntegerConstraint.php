<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is an integer.
 */
class IntegerConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * IntegerConstraint constructor.
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
        return is_int($value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be an integer number.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
