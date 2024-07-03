<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'company_id'
    ];
    
    protected $casts = [
        'id' => 'string',
    ];

    public function Company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
}
