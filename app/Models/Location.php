<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'location_name',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function scopeSearch($query,$search){
        if($search!=''){
            $locations = $query->orderBy('id','DESC')->where('location_name', 'like', '%'.$search.'%')->paginate(8)->appends(request()->query());
        }else{
            $locations = $query->orderBy('id','DESC')->paginate(8)->onEachSide(1);
        }
        return $locations;
    }
}
