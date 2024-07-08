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
        '1st_week',
        '2st_week',
        '3rd_week',
        '4th_week',
        '5th_week',
        'date_from',
        'date_to',
        'remarks_1',
        'remarks_2',
        'remarks_3',
        'remarks_4',
        'remarks_5',
        'assigned',
        'is_onetime',
    ];

    protected $casts = [
        'id' => 'string',
        'inventory_id'=>'string',
        'location_id'=>'string',
        'frequency_id'=>'string'
    ];

}
