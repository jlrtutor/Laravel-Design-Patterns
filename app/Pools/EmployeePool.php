<?php

namespace App\Pools;

use App\Models\Employee;


class EmployeePool
{
    private array $occupiedEmployees;
    private array $freeEmployees;
    private array $names;


    public function __construct(array $names)
    {
        $this->names = $names;
        $this->occupiedEmployees = [];
        $this->freeEmployees = [];
    }

    /**
     * @return Employee|mixed|null
     */
    public function getEmployee()
    {
        if (count($this->getOccupiedEmployees()) < count($this->names)) {
            $randomIdName = array_rand($this->getFreeEmployees(), 1);
            $employee = new Employee($randomIdName, $this->names[$randomIdName]);
            $this->occupiedEmployees[$employee->getId()] = $employee;
        } else {
            $occupiedEmployees = $this->getOccupiedEmployees();
            $employee = array_pop($occupiedEmployees);
            echo "<p><b>Reuse</b> Employee " . $employee->name . "</p>";
        }
        return $employee;
    }

    /**
     * @param Employee $employee
     * @return void
     */
    public function release(Employee $employee): void
    {
        $id = $employee->getId();

        if (isset($this->occupiedEmployees[$id])) {
            unset($this->occupiedEmployees[$id]);
            $this->freeEmployees[$id] = $employee;
        }
    }

    /**
     * @return array
     */
    public function getOccupiedEmployees(): array
    {
        return $this->occupiedEmployees;
    }

    /**
     * @return array
     */
    public function getFreeEmployees(): array
    {
        $freeEmployees = [];
        $freeEmployeesIds = array_diff(array_keys($this->names), array_keys($this->occupiedEmployees));
        foreach ($freeEmployeesIds as $freeEmployeeId) {
            $freeEmployees[$freeEmployeeId] = $this->names[$freeEmployeeId];
        }

        return $freeEmployees;
    }
}
