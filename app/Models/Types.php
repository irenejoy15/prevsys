<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type_name',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function scopeSearch($query,$search){
        if($search!=''){
            $types = $query->orderBy('id','DESC')->where('type_name', 'like', '%'.$search.'%')->paginate(8)->appends(request()->query());
        }else{
            $types = $query->orderBy('id','DESC')->paginate(8)->onEachSide(1);
        }
        return $types;
    }
}
