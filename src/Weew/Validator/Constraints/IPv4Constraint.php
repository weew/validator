<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value is a valid IP v4 address.
 */
class IPv4Constraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * IPv4Constraint constructor.
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
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'Must be an IPv4 address.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
