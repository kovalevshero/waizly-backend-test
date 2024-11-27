<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'name',
        'job_title',
        'salary',
        'department',
        'joined_date',
    ];

    // Define the relationship with SalesData
    public function salesData()
    {
        return $this->hasMany(SalesData::class, 'employee_id', 'employee_id');
    }
}
