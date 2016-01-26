<?php

namespace Weew\Validator\Constraints;

use Weew\Validator\IConstraint;
use Weew\Validator\IValidationData;

/**
 * Considers domains as valid according to the following requirements:
 *
 * - Each label/level (splitted by a dot) may contain up to 63 characters.
 * - The full domain name may have up to 127 levels.
 * - The full domain name may not exceed the length of 253 characters in its textual representation.
 * - Each label can consist of letters, digits and hyphens.
 * - Labels cannot start or end with a hyphen.
 * - The top-level domain (extension) cannot be all-numeric.
 *
 * NOTE: All internationalized domain names (IDN) are not seen as valid by this constraint!
 *
 * Credit for research and regex belongs to Onur Yildirim
 * @link http://stackoverflow.com/questions/3026957/how-to-validate-a-domain-name-using-regex-php#16491074
 *
 */
class DomainNameConstraint implements IConstraint {
    /**
     * @var string
     */
    protected $message;

    /**
     * DomainNameConstraint constructor.
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
        if (is_string($value) && strlen($value) <= 253) {
            return 1 === preg_match('/^(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/', $value);
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

        return 'Must be a valid domain name.';
    }

    /**
     * @return array
     */
    public function getOptions() {
        return [];
    }
}
