<?php

namespace App\Http\Controllers;

use App\Pools\EmployeePool;

class CreationalPool extends Controller
{
    private EmployeePool $pool;
    /**
     * @return void
     */
    public function index(): void
    {
        $this->pool = new EmployeePool(['William', 'Chris', 'Elsa', 'Jane', 'Bob']);

        $employee1 = $this->getEmployee();
        $employee2 = $this->getEmployee();

        $this->showOccupiedEmployees();
        $this->showFreeEmployees();

        $this->releaseEmployee($employee2);

        $this->showOccupiedEmployees();
        $this->showFreeEmployees();
    }

    /**
     * @return void
     */
    private function showOccupiedEmployees(): void
    {
        echo "<h3>Occupied Employees</h3>";
        foreach ($this->pool->getOccupiedEmployees() as $occupiedEmployee) {
            echo "<p>" . $occupiedEmployee->getInfo(). "</p>";
        }
    }

    /**
     * @return void
     */
    private function showFreeEmployees(): void
    {
        echo "<h3>Free Employees</h3>";
        foreach ($this->pool->getFreeEmployees() as $freeEmployeeId => $freeEmployee) {
            echo "<p>ID: " . $freeEmployeeId . "; Name: " . $freeEmployee . "</p>";
        }
    }

    /**
     * @param mixed $employee
     * @return void
     */
    private function releaseEmployee(mixed $employee): void
    {
        echo "<h3>Release Employee ID:{$employee->getId()}</h3>";
        $this->pool->release($employee);
    }

    private function getEmployee()
    {
        return $this->pool->getEmployee();
    }
}
