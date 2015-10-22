<?php

namespace Weew\Validator;

interface IValidator {
    /**
     * @param $data
     * @param IConstraintGroup[] $groups
     *
     * @return IValidationResult
     */
    function check($data, array $groups);

    /**
     * @return IPropertyReader
     */
    function getPropertyReader();

    /**
     * @param IPropertyReader $propertyReader
     */
    function setPropertyReader(IPropertyReader $propertyReader);

    /**
     * @return IConstraintGroup[]
     */
    function getConstraints();
}
