<?php

namespace App\Models;

use App\Orchid\Presenters\FromPresenter;
use App\Orchid\Presenters\OverheadPresenter;
use App\Orchid\Presenters\ToPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Overhead extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        "order_code",
        "overhead_code",
        "from_city",
        "from_name",
        "from_company",
        "from_address",
        "from_phone",
        "to_name",
        "to_company",
        "to_address",
        "to_phone",
        "to_city",
        "counterparty", // Контрагент
        "company_type", // Юр. лицо / Физ. лицо
        "cargo_details",
        "is_package", // Упаковка (да, нет)
        "mass",
        "width",
        "height",
        "length",
        "volume",
        "price",
        "need_movers", // Необходимы грузчики забор
        "comment",
        "description",
        "order_start_date",
        "order_end_date",
        "user_id",
        "last_status",
        "driver",
        "transport_id",
        "registry_id",
    ];

    protected $allowedSorts = ['from_city', 'to_city'];

    public function getHistories(){
        return $this->hasMany(History::class);
    }

    public function presenterOverhead(): OverheadPresenter
    {
        return new OverheadPresenter($this);
    }
    public function presenterFrom(): FromPresenter
    {
        return new FromPresenter($this);
    }
    public function presenterTo(): ToPresenter
    {
        return new ToPresenter($this);
    }
}
