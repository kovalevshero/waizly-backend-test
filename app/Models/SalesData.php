<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{
    use HasFactory;

    protected $table = 'sales_data';
    protected $primaryKey = 'sales_id';
    protected $fillable = [
        'employee_id',
        'sales',
    ];

    // Define the relationship with Employees
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employees_id');
    }
}
