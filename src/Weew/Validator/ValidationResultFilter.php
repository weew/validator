<?php

namespace Weew\Validator;

use Weew\Validator\Constraints\NullableConstraint;

class ValidationResultFilter {
    /**
     * @param IValidationResult $result
     *
     * @return IValidationResult
     */
    public function removeNullableErrors(IValidationResult $result) {
        $nullableSubjects = $this->getNullableSubjects($result);
        $filteredResult = new ValidationResult();

        foreach ($result->getErrors() as $error) {
            if ( ! $this->shouldErrorBeIgnored($nullableSubjects, $error)) {
                $filteredResult->addError($error);
            }
        }

        return $filteredResult;
    }

    /**
     * @param IValidationResult $result
     *
     * @return array
     */
    protected function getNullableSubjects(IValidationResult $result) {
        $nullableSubjects = [];

        foreach ($result->getErrors() as $error) {
            if ($error->getConstraint() instanceof NullableConstraint) {
                $nullableSubjects[] = $error->getSubject();
            }
        }

        return $nullableSubjects;
    }

    /**
     * @param array $nullableSubjects
     * @param IValidationError $error
     *
     * @return bool
     */
    protected function shouldErrorBeIgnored(array $nullableSubjects, IValidationError $error) {
        if ($error->getConstraint() instanceof NullableConstraint) {
            return true;
        }

        foreach ($nullableSubjects as $subject) {
            if (str_starts_with($error->getSubject(), $subject)) {
                return true;
            }
        }

        return false;
    }
}
