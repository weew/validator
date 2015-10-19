<?php

namespace Weew\Validator;

interface IPropertyAccessor {
    /**
     * @param $abstract
     *
     * @return bool
     */
    function supports($abstract);

    /**
     * @param $abstract
     * @param $property
     *
     * @return mixed
     */
    function getProperty($abstract, $property);
}
