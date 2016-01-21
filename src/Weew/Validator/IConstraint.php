<?php

namespace Weew\Validator;

interface IConstraint {
    /**
     * @param $value
     *
     * @return bool
     */
    function check($value);

    /**
     * @return string
     */
    function getMessage();

    /**
     * @return array
     */
    function getOptions();
}
