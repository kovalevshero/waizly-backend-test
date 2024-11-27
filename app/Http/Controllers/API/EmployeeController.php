<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employee.
     */
    public function index()
    {
        try {
            $employees = Employee::all();

            return $this->successResponse('Data fetched successfully', $employees);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'job_title' => 'required|string|max:255',
                'salary' => 'required|numeric',
                'department' => 'required|string|max:255',
                'joined_date' => 'required|date',
            ]);

            $employee = Employee::create($validatedData);

            return $this->successResponse('Data created successfully', $employee, 201);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Display employee.
     */
    public function show(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            return $this->successResponse('Data fetched successfully', $employee);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Update employee in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'job_title' => 'sometimes|required|string|max:255',
                'salary' => 'sometimes|required|numeric',
                'department' => 'sometimes|required|string|max:255',
                'joined_date' => 'sometimes|required|date',
            ]);

            $employee = Employee::findOrFail($id); // Check if exists
            $employee->update($validatedData);

            return $this->successResponse('Data updated successfully', $employee);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Remove employee from storage.
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id); // Check if exists
            $employee->delete();

            return $this->successResponse('Data deleted successfully');
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
