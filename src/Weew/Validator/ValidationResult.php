<?php

namespace Weew\Validator;

class ValidationResult implements IValidationResult {
    /**
     * @var IValidationError[]
     */
    protected $errors = [];

    /**
     * @param IValidationError $error
     */
    public function addError(IValidationError $error) {
        $this->errors[] = $error;
    }

    /**
     * @param IValidationError[] $errors
     */
    public function addErrors(array $errors) {
        foreach ($errors as $error) {
            $this->addError($error);
        }
    }

    /**
     * @return IValidationError[]
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function isOk() {
        return $this->errorCount() === 0;
    }

    /**
     * @return bool
     */
    public function isFailed() {
        return ! $this->isOk();
    }

    /**
     * @return int
     */
    public function errorCount() {
        return count($this->getErrors());
    }
}