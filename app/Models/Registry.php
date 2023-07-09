<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Screen\AsSource;

class Registry extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'from_city',
        'to_city',
        'user_id',
        'status_id',
    ];

    protected $allowedFilters = ['from_city'=>Where::class,];
    protected $allowedSorts = ['from_city', 'to_city'];
    public function getOverheads(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->hasMany(Overhead::class, 'registry_id','id')->get();
    }
}
