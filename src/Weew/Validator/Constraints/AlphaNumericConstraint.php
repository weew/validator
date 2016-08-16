<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value consists of alphabetical or numerical characters.
 */
class AlphaNumericConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * AlphaNumericConstraint constructor.
     *
     * @param string $message
     */
    public function __construct($message = null) {
        $this->message = $message;
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    public function check($value, IValidationData $data = null) {
        if (is_scalar($value)) {
            return preg_match('/^[[:alnum:]]+$/u', $value) === 1;
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

        return 'Must consist of alpha numeric characters.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
