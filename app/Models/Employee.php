<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'company_id'];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
