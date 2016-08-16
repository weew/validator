<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

class MinValueConstraint implements IConstraint {
    /**
     * @var int
     */
    protected $min;

    /**
     * @var string
     */
    protected $message;

    /**
     * MinValueConstraint constructor.
     *
     * @param int $min
     * @param string $message
     */
    public function __construct($min, $message = null) {
        $this->min = $min;
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
            return $value >= $this->min;
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
            'Must not be smaller than "%s".', $this->min
        );
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
