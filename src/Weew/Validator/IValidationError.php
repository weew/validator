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
     * @return IConstraint
     */
    function getConstraint();
}
