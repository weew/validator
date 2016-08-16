<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value has exactly the given length.
 */
class LengthConstraint implements IConstraint {
    /**
     * @var int
     */
    protected $length;

    /**
     * @var string
     */
    protected $message;

    /**
     * LengthConstraint constructor.
     *
     * @param $length
     * @param string $message
     */
    public function __construct($length, $message = null) {
        $this->length = $length;
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
            return strlen($value) === $this->length;
        } else if (is_array($value)) {
            return count($value) === $this->length;
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

        return s('Must have a length of "%s".', $this->length);
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'length' => $this->length,
        ];
    }
}
