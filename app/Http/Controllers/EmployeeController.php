<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function getEmployees()
    {
        return $this->employeeService->getEmployees();
    }

    public function addEmployee(Request $request,$company_id)
    {
        return $this->employeeService->addEmployee($request, $company_id);
    }

    public function updateEmployee(Request $request, Employee $employee)
    {
        return $this->employeeService->updateEmployee($request, $employee);
    }

    public function deleteEmployee(Employee $employee)
    {
        return $this->employeeService->deleteEmployee($employee);
    }
}

