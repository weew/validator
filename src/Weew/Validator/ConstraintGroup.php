<?php

namespace Weew\Validator;

class ConstraintGroup implements IConstraintGroup {
    /**
     * @var string
     */
    protected $name;

    /**
     * @var IConstraint[]
     */
    protected $constraints;

    /**
     * @param $name
     * @param IConstraint[] $constraints
     */
    public function __construct($name, array $constraints = []) {
        $this->setName($name);
        $this->setConstraints($constraints);
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param IConstraint $constraint
     */
    public function addConstraint(IConstraint $constraint) {
        $this->constraints[] = $constraint;
    }

    /**
     * @param IConstraint[] $constraints
     */
    public function addConstraints(array $constraints) {
        foreach ($constraints as $constraint) {
            $this->addConstraint($constraint);
        }
    }

    /**
     * @return IConstraint[]
     */
    public function getConstraints() {
        return $this->constraints;
    }

    /**
     * @param IConstraint[] $constraints
     */
    public function setConstraints(array $constraints) {
        $this->constraints = [];
        $this->addConstraints($constraints);
    }

    /**
     * @param IConstraintGroup $group
     */
    public function extend(IConstraintGroup $group) {
        $this->addConstraints($group->getConstraints());
    }

    /**
     * @param $value
     * @param IValidationData $data
     *
     * @return ValidationResult
     */
    public function check($value, IValidationData $data = null) {
        $result = new ValidationResult();

        foreach ($this->getConstraints() as $constraint) {
            if ( ! $constraint->check($value, $data)) {
                $result->addError(
                    new ValidationError($this->getName(), $value, $constraint)
                );
            }
        }

        return $result;
    }
}
