<?php

namespace Weew\Validator;

interface IValidationError {
    /**
     * @return string
     */
    function getSubject();

    /**
     * @return mixed
     */
    function getValue();

    /**
     * @return string
     */
    function getMessage();

    /**
     * @return IConstraint
     */
    function getConstraint();
}
