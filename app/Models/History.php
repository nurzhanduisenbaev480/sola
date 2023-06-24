<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class History extends Model
{
    use HasFactory;
    use AsSource;
    protected $fillable = [
        "status_id",
        "user_id",
        "overhead_id",
        "history_name",
        "is_show",
    ];
}
