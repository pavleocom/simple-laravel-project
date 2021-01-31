<?php

namespace App\Observers;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCreatedMarkdown;

class EmployeeObserver
{
    public function created(Employee $employee)
    {
        if (Auth::check()) {
            Mail::to(Auth::user())->queue(new EmployeeCreatedMarkdown($employee));
        }   
    }

}
