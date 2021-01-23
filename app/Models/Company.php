<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'logo', 'website'];

    public function employees()
    {
        return $this->hasMany('App\Models\Employee', 'company_id');
    }

    public function logoUrl()
    {
        if ($this->logo === null) {
            $logoUrl = Storage::url('/logos/no_image_available.jpg');
        } else {
            $logoUrl = Storage::url($this->logo);
        }
        
        return $logoUrl;
    }
}
