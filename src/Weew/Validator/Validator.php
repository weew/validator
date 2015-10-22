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
    protected $constraints = [];

    /**
     * @param IPropertyReader|null $propertyReader
     */
    public function __construct(IPropertyReader $propertyReader = null) {
        if ($propertyReader instanceof IPropertyReader) {
            $propertyReader = $this->createPropertyReader();
        }

        $this->setPropertyReader($propertyReader);
    }

    /**
     * @param $data
     * @param array $groups
     *
     * @return IValidationResult
     */
    public function check($data, array $groups = []) {
        $groups = array_extend($this->getConstraints(), $groups);
        $result = $this->applyConstraints($data, $groups);

        return $result;
    }

    /**
     * @return IConstraintGroup[]
     */
    public function getConstraints() {
        return $this->constraints;
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
     * @param $data
     * @param IConstraintGroup[] $groups
     *
     * @return IValidationResult
     */
    protected function applyConstraints($data, array $groups) {
        $result = new ValidationResult();

        foreach ($groups as $group) {
            $propertyName = $group->getName();

            foreach ($group->getConstraints() as $constraint) {
                $propertyValue = $this->getPropertyReader()
                    ->readProperty($data, $propertyName);

                if ( ! $constraint->check($propertyValue)) {
                    $result->addError(
                        new ValidationError($propertyName, $propertyValue, $constraint)
                    );
                }
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
}
