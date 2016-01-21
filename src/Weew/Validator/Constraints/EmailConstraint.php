<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is valid email address.
 */
class EmailConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * EmailConstraint constructor.
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
        if (is_string($value)) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be an email address.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
