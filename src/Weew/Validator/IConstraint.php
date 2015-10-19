<?php

namespace Weew\Validator;

use Weew\Foundation\Interfaces\IArrayable;

interface IConstraint extends IArrayable {
    /**
     * @param $abstract
     *
     * @return bool
     */
    function check($abstract);
}
