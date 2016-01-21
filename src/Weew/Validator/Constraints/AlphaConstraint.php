<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value consists of alphabetical characters.
 */
class AlphaConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * AlphaConstraint constructor.
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
            return preg_match('/^[[:alpha:]]+$/u', $value) === 1;
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

        return 'Must consist of alphabetical characters.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
