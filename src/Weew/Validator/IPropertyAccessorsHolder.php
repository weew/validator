<?php

namespace Weew\Validator;

interface IPropertyAccessorsHolder {
    /**
     * @param IPropertyAccessor $propertyAccessor
     */
    function addPropertyAccessor(IPropertyAccessor $propertyAccessor);

    /**
     * @return IPropertyAccessor[]
     */
    function getPropertyAccessors();

    /**
     * @param array $propertyAccessors
     */
    function setPropertyAccessors(array $propertyAccessors);
}
