<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'about_text',
        'mission',
        'vision',
        'address',
    ];
}
