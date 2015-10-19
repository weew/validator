<?php

namespace Weew\Validator;

interface IPropertyAccessor {
    /**
     * @param $abstract
     * @param $property
     *
     * @return bool
     */
    function supports($abstract, $property);

    /**
     * @param $abstract
     * @param $property
     *
     * @return mixed
     */
    function getProperty($abstract, $property);
}
