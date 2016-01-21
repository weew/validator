<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a float.
 */
class FloatConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * FloatConstraint constructor.
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
        return is_float($value);
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be a float number.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
