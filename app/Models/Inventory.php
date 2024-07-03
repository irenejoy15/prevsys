<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'inventory_name',
        'type_id',
        'department_id',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function scopeSearch($query,$search){
        if($search!=''){
            $inventories = $query->orderBy('id','DESC')->where('inventory_name', 'like', '%'.$search.'%')->paginate(8)->appends(request()->query());
        }else{
            $inventories = $query->orderBy('id','DESC')->paginate(8)->onEachSide(1);
        }
        return $inventories;
    }

    public function Type(){
        return $this->belongsTo(Types::class,'type_id','id');
    }

    public function Department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }
}
