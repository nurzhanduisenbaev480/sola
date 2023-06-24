<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Driver extends Model
{
    use HasFactory;
    use AsSource;
    protected $fillable = [
        'name',
        'username',
        'from_company',
        'from_city',
        'from_phone',
        'from_address',
        'from_site',
        'password',
        'type',
        'company_type',
        'iin',
        'permissions',
    ];
}
