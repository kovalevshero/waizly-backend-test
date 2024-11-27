<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SalesData;
use Exception;
use Illuminate\Http\Request;

class SalesDataController extends Controller
{
    /**
     * Display a listing of sales data.
     */
    public function index()
    {
        try {
            $salesData = SalesData::all();

            return $this->successResponse('Data fetched successfully', $salesData);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Store a newly created sales data in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'employee_id' => 'required|exists:employees,employees_id',
                'sales' => 'required|numeric',
            ]);

            $salesData = SalesData::create($validatedData);

            return $this->successResponse('Data created successfully', $salesData, 201);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Display sales data.
     */
    public function show(string $id)
    {
        try {
            $salesData = SalesData::findOrFail($id);

            return $this->successResponse('Data fetched successfully', $salesData);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Update sales data in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'employee_id' => 'sometimes|required|exists:employees,employees_id',
                'sales' => 'sometimes|required|numeric',
            ]);

            $salesData = SalesData::findOrFail($id); // Check if exists
            $salesData->update($validatedData);

            return $this->successResponse('Data updated successfully', $salesData);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Remove sales data from storage.
     */
    public function destroy(string $id)
    {
        try {
            $salesData = SalesData::findOrFail($id); // Check if exists
            $salesData->delete();

            return $this->successResponse('Data deleted successfully');
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
