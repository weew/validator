<?php

namespace Weew\Validator;

interface IValidationData {
    /**
     * @param string $key
     *
     * @return array
     */
    function get($key);
}
