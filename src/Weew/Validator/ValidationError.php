<?php

namespace Weew\Validator;

class ValidationError implements IValidationError {
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var IConstraint
     */
    protected $constraint;

    /**
     * @param $subject
     * @param $value
     * @param IConstraint $constraint
     */
    public function __construct($subject, $value, IConstraint $constraint) {
        $this->subject = $subject;
        $this->value = $value;
        $this->constraint = $constraint;
    }

    /**
     * @return string
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @return IConstraint
     */
    public function getConstraint() {
        return $this->constraint;
    }
}
