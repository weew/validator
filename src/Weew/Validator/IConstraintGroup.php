<?php

namespace Weew\Validator;

interface IConstraintGroup {
    /**
     * @return string
     */
    function getName();

    /**
     * @param string $name
     */
    function setName($name);

    /**
     * @param IConstraint $constraint
     */
    function addConstraint(IConstraint $constraint);

    /**
     * @param IConstraint[] $constraints
     */
    function addConstraints(array $constraints);

    /**
     * @return IConstraint[]
     */
    function getConstraints();

    /**
     * @param IConstraint[] $constraints
     */
    function setConstraints(array $constraints);

    /**
     * @param IConstraintGroup $group
     */
    function extend(IConstraintGroup $group);

    /**
     * @param $value
     *
     * @return IValidationResult
     */
    function check($value);
}
