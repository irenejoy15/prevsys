<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'department_name',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function scopeSearch($query,$search){
        if($search!=''){
            $departments = $query->orderBy('id','DESC')->where('department_name', 'like', '%'.$search.'%')->paginate(8)->appends(request()->query());
        }else{
            $departments = $query->orderBy('id','DESC')->paginate(8)->onEachSide(1);
        }
        return $departments;
    }
}
