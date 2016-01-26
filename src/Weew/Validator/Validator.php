<?php

namespace Weew\Validator;

class Validator implements IValidator {
    /**
     * @var IPropertyReader
     */
    protected $propertyReader;

    /**
     * @var IConstraintGroup[]
     */
    protected $constraintGroups = [];

    /**
     * @param IPropertyReader|null $propertyReader
     */
    public function __construct(IPropertyReader $propertyReader = null) {
        if ( ! $propertyReader instanceof IPropertyReader) {
            $propertyReader = $this->createPropertyReader();
        }

        $this->setPropertyReader($propertyReader);
        $this->configure();
    }

    /**
     * @param $data
     * @param array $groups
     *
     * @return IValidationResult
     */
    public function check($data, array $groups = []) {
        $groups = array_extend($this->getConstraintGroups(), $groups);

        return $this->applyConstraints($data, $groups);
    }

    /**
     * @return IConstraintGroup[]
     */
    public function getConstraintGroups() {
        return $this->constraintGroups;
    }

    /**
     * @return IPropertyReader
     */
    public function getPropertyReader() {
        return $this->propertyReader;
    }

    /**
     * @param IPropertyReader $propertyReader
     */
    public function setPropertyReader(IPropertyReader $propertyReader) {
        $this->propertyReader = $propertyReader;
    }

    /**
     * @param $name
     * @param IConstraint $constraint
     *
     * @return $this
     */
    public function addConstraint($name, IConstraint $constraint) {
        $this->addConstraintGroup(new ConstraintGroup($name, [$constraint]));

        return $this;
    }

    /**
     * @param $name
     * @param array $constraints
     *
     * @return $this
     */
    public function addConstraints($name, array $constraints) {
        $this->addConstraintGroup(new ConstraintGroup($name, $constraints));

        return $this;
    }

    /**
     * @param IConstraintGroup $group
     *
     * @return $this
     */
    public function addConstraintGroup(IConstraintGroup $group) {
        $currentGroup = $this->findConstraintGroup($group->getName());

        if ($currentGroup instanceof IConstraintGroup) {
            $currentGroup->extend($group);
        } else {
            $this->constraintGroups[] = $group;
        }

        return $this;
    }

    /**
     * Use this method as an extension point for custom validators.
     */
    protected function configure() {}

    /**
     * @param $name
     *
     * @return null|IConstraintGroup
     */
    protected function findConstraintGroup($name) {
        foreach ($this->getConstraintGroups() as $group) {
            if ($group->getName() === $name) {
                return $group;
            }
        }

        return null;
    }

    /**
     * @param $data
     * @param IConstraintGroup[] $groups
     *
     * @return IValidationResult
     */
    protected function applyConstraints($data, array $groups) {
        $result = new ValidationResult();
        $data = $this->createValidationData($data);

        foreach ($groups as $group) {
            $value = $data->get($group->getName());
            $groupResult = $group->check($value, $data);

            if ($groupResult->isFailed()) {
                $result->extend($groupResult);
            }
        }

        return $result;
    }

    /**
     * @return PropertyReader
     */
    protected function createPropertyReader() {
        return new PropertyReader();
    }

    /**
     * @param $data
     *
     * @return IValidationData
     */
    protected function createValidationData($data) {
        return new ValidationData($this->getPropertyReader(), $data);
    }
}
