<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Status extends Model
{
    use HasFactory;
    use AsSource;
    protected $fillable = [
        "status_name",
        "status_code",
    ];
}
