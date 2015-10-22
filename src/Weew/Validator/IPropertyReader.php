<?php

namespace Weew\Validator;

interface IPropertyReader {
    /**
     * @param $source
     * @param $propertyName
     *
     * @return mixed|null
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
