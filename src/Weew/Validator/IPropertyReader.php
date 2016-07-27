<?php

namespace Weew\Validator;

interface IPropertyReader {
    /**
     * @param mixed $source
     * @param string $propertyName
     *
     * @return mixed
     */
    function getProperty($source, $propertyName);

    /**
     * @return IPropertyAccessor[]
     */
    function getPropertyAccessors();

    /**
     * @param IPropertyAccessor[] $accessors
     */
    function setPropertyAccessors(array $accessors);

    /**
     * @param IPropertyAccessor $propertyAccessor
     */
    function addPropertyAccessor(IPropertyAccessor $propertyAccessor);
}
