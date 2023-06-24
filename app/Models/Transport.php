<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Transport extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'user_id',
        'transport_name',
        'transport_code',
        'transport_type',
    ];
}
