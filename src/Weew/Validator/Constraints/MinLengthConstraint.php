<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;

/**
 * Check if the value has the given min length.
 */
class MinLengthConstraint implements IConstraint {
    /**
     * @var int
     */
    protected $min;

    /**
     * @var string
     */
    protected $message;

    /**
     * MinLengthConstraint constructor.
     *
     * @param $min
     * @param string $message
     */
    public function __construct($min, $message = null) {
        $this->min = $min;
        $this->message = $message;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function check($value) {
        if (is_string($value)) {
            return strlen($value) >= $this->min;
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

        return s('Must not be shorter then "%s" characters.', $this->min);
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'min' => $this->min,
        ];
    }
}
