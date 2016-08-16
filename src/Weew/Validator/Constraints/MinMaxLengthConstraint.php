<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value's length is in the given range.
 */
class MinMaxLengthConstraint implements IConstraint {
    /**
     * @var int
     */
    protected $min;

    /**
     * @var int
     */
    protected $max;

    /**
     * @var string
     */
    protected $message;

    /**
     * MinMaxLengthConstraint constructor.
     *
     * @param $min
     * @param $max
     * @param string $message
     */
    public function __construct($min, $max, $message = null) {
        $this->min = $min;
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
            $length = strlen($value);

            return $length >= $this->min && $length <= $this->max;
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

        return s(
            'Must be between "%s" and "%s" characters long.',
            $this->min, $this->max
        );
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'min' => $this->min,
            'max' => $this->max,
        ];
    }
}
