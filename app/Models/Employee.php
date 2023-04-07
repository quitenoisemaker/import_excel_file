<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'age'
    ];

    public static function getEmployeeRecords()
    {
        return self::select('id', 'name', 'email', 'age')->OrderBy('id', 'DESC')->get();
    }
}
