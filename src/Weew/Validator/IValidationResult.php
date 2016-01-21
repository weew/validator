<?php

namespace Weew\Validator;

use Weew\Contracts\IArrayable;

interface IValidationResult extends IArrayable {
    /**
     * @param IValidationError $error
     */
    function addError(IValidationError $error);

    /**
     * @param IValidationError[] $errors
     */
    function addErrors(array $errors);

    /**
     * @return IValidationError[]
     */
    function getErrors();

    /**
     * @return bool
     */
    function isOk();

    /**
     * @return bool
     */
    function isFailed();

    /**
     * @return int
     */
    function errorCount();

    /**
     * @param IValidationResult $result
     */
    function extend(IValidationResult $result);
}
