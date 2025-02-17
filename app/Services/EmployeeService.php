<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EmployeeService
{
    public function getEmployees()
    {
        $employees = Employee::all();

        return response()->json($employees);
    }

    public function getEmployee($id)
    {
        $result = Employee::findOrFail($id);

        return response()->json([
            'employee' => $result
        ]);
    }

    public function addEmployee(Request $request, $company_id)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:employees',
            'phone' => 'required|string',
        ]);

        Employee::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'company_id' => $company_id,
        ]);

        return response()->json([
            'message' => 'Employee added successfully'
        ]);
    }

    public function updateEmployee(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'company_id' => 'nullable|exists:companies,id',
        ]);

        $employee->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone')
        ]);

        return response()->json([
            'message' => 'Employee updated successfully'
        ]);
    }

    public function deleteEmployee(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully'
        ]);
    }
}
