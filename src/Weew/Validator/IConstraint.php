<?php

namespace Weew\Validator;

interface IConstraint {
    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return bool
     */
    function check($value, IValidationData $data = null);

    /**
     * @return string
     */
    function getMessage();

    /**
     * @return array
     */
    function getOptions();
}
