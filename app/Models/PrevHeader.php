<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrevHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'inventory_id',
        'location_id',
        'frequency_id',
        'company_id',
        'department_id',
        'name',
        'week_from',
        'week_to',
        'date_from',
        'date_to',
        'remarks_1',
        'remarks_2',
        'remarks_3',
        'remarks_4',
        'remarks_5',
        'assigned',
        'is_onetime',
        'month',
        'year'
    ];

    protected $casts = [
        'id' => 'string',
        'inventory_id'=>'string',
        'location_id'=>'string',
        'frequency_id'=>'string'
    ];

    public function Location(){
        return $this->belongsTo(Location::class,'location_id','id');
    }

    public function Inventory(){
        return $this->belongsTo(Inventory::class,'inventory_id','id');
    }
}
