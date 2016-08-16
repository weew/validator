<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value is inside the given range.
 */
class MinMaxConstraint implements IConstraint {
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
     * MinMaxConstraint constructor.
     *
     * @param int $min
     * @param int $max
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
        if (is_numeric($value)) {
            return $value >= $this->min && $value <= $this->max;
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
            'Must have a value between "%s" and "%s".',
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
