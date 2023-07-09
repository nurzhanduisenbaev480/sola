<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Contragent extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'name', 'iin', 'payment_type',
        'company_name', 'company_address',
        'company_real_address', 'bin', 'bik',
        'payment_card', 'bank_name', 'director_name',
        'email', 'phone'
    ];
}
