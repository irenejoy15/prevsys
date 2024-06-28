<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company_name',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function scopeSearch($query,$search){
        if($search!=''){
            $companies = $query->orderBy('id','DESC')->where('company_name', 'like', '%'.$search.'%')->paginate(8)->appends(request()->query());
        }else{
            $companies = $query->orderBy('id','DESC')->paginate(8)->onEachSide(1);
        }
        return $companies;
    }
}
