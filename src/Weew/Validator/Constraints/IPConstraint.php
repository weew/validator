<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a valid IP address.
 */
class IPConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * IPConstraint constructor.
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
        return filter_var($value, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be an IP address.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
