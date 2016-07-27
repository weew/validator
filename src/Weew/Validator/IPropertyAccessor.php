<?php

namespace Weew\Validator;

interface IPropertyAccessor {
    /**
     * @param mixed $abstract
     * @param string $property
     *
     * @return bool
     */
    function supports($abstract, $property);

    /**
     * @param mixed $abstract
     * @param string $property
     *
     * @return mixed
     */
    function getProperty($abstract, $property);
}
