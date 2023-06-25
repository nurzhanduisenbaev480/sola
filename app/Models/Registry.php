<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Registry extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'from_city',
        'to_city',
        'user_id',
        'status_id',
    ];

    public function getOverheads(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->hasMany(Overhead::class, 'registry_id','id')->get();
    }
}
