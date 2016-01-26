<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Check if the value matches given regex pattern.
 */
class RegexConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var string
     */
    protected $message;

    /**
     * RegexConstraint constructor.
     *
     * @param $pattern
     * @param string $message
     */
    public function __construct($pattern, $message = null) {
        $this->pattern = $pattern;
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
            return preg_match($this->pattern, $value) === 1;
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

        return s('Must match regex pattern "%s".', $this->pattern);
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [
            'pattern' => $this->pattern,
        ];
    }
}
