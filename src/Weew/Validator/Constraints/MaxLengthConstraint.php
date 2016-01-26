<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value has the given max length.
 */
class MaxLengthConstraint implements IConstraint {
    /**
     * @var int
     */
    protected $max;

    /**
     * @var string
     */
    protected $message;

    /**
     * MaxLengthConstraint constructor.
     *
     * @param $max
     * @param string $message
     */
    public function __construct($max, $message = null) {
        $this->max = $max;
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        if (is_string($value)) {
            return strlen($value) <= $this->max;
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

        return s('Must not be longer then "%s" characters.', $this->max);
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'max' => $this->max
        ];
    }
}
