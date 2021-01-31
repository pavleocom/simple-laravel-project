<?php

namespace App\Observers;

use App\Models\Company;
use App\Mail\CompanyCreatedMarkdown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function created(Company $company)
    {
        if (Auth::check()) {
            Mail::to(Auth::user())->queue(new CompanyCreatedMarkdown($company));
        }   
    }

}
