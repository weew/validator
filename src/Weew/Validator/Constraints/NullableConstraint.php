<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * This constraint is used to allow to tag a specific
 * subject as "optional". Validator will remove any errors
 * that occurred for the given subject if the subject value
 * is null or '' where this constraint has been applied.
 */
class NullableConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * FloatConstraint constructor.
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
        return array_contains([null, ''], $value) ? false : true;
    }

    /**
     * @return string
     */
    public function getMessage() {
        if ($this->message !== null) {
            return $this->message;
        }

        return 'May be null.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
