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
    function getConstraintGroups();

    /**
     * @param string $name
     * @param IConstraint $constraint
     *
     * @return IValidator
     */
    function addConstraint($name, IConstraint $constraint);

    /**
     * @param string $name
     * @param array $constraints
     *
     * @return IValidator
     */
    function addConstraints($name, array $constraints);

    /**
     * @param IConstraintGroup $constraintGroup
     *
     * @return IValidator
     */
    function addConstraintGroup(IConstraintGroup $constraintGroup);
}
