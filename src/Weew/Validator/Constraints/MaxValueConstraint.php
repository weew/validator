<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

class MaxValueConstraint implements IConstraint {
    /**
     * @var int
     */
    protected $max;

    /**
     * @var string
     */
    protected $message;

    /**
     * MaxValueConstraint constructor.
     *
     * @param int $max
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
        if (is_numeric($value)) {
            return $value <= $this->max;
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
            'Must not be greater than "%s".', $this->max
        );
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'max' => $this->max,
        ];
    }
}
