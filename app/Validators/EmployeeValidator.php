<?php

namespace App\Validators;

use App\Models\Employee;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EmployeeValidator
{
    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    private static function rules()
    {
        return [
            "emp_id" => [new NotBlank(), new GreaterThan(0)],
            "emp_name" => [
                new NotBlank(),
                new Length(['min' => 1]),
                new Regex([
                    'pattern' => '/\s/',
                    'match' => false,
                    'message' => "Не должно быть пробелов"
                ])
            ],
            "emp_wage" => [new NotBlank(), new GreaterThanOrEqual(1)],
            "emp_hireDate" => [new NotBlank(), new LessThanOrEqual('today UTC'), new GreaterThanOrEqual('-20 years')]
        ];
    }

    public static function validate(Employee $employee)
    {
        $validator = Validation::createValidator();
        $violations = [];

        foreach (EmployeeValidator::rules() as $key => $rules) {
            $violations[] = $validator->validate($employee->$key, $rules);
        }

        return $violations;
    }

    public static function printErrors(array $fieldsErrors)
    {
        foreach ($fieldsErrors as $fieldErrors) {
            foreach ($fieldErrors as $error) {
                echo "{$error->getRoot()} => ";
                echo "{$error->getMessage()} <br/>";
            }
        }
    }

    public static function Info(Employee $employee)
    {
        EmployeeValidator::printErrors(
            EmployeeValidator::validate($employee)
        );
    }
}