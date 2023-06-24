<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class City extends Model
{
    use HasFactory;
    use AsSource;
    protected $fillable = [
        "city_id",
        "city_name",
        "city_area",
        "city_country",
    ];
}
