<?php

namespace Weew\Validator;

interface IValidationData {
    /**
     * @param $key
     * @param null $defaultValue
     */
    function get($key, $defaultValue = null);
}
