<?php

namespace Weew\Validator;

interface IPropertyAccessorsHolder {
    /**
     * @param IPropertyAccessor $accessor
     */
    function addAccessor(IPropertyAccessor $accessor);

    /**
     * @param array $accessors
     *
     * @return IPropertyAccessor[]
     */
    function getAccessors(array $accessors);

    /**
     * @param array $accessors
     */
    function setAccessors(array $accessors);
}
