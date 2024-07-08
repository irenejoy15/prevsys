<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'frequency',
        'is_jan',
        'is_feb',
        'is_mar',
        'is_apr',
        'is_may',
        'is_jun',
        'is_jul',
        'is_aug',
        'is_sept',
        'is_oct',
        'is_nov',
        'is_dec',
        'year_interval'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function scopeSearch($query,$search){
        if($search!=''){
            $frequencies = $query->orderBy('id','DESC')->where('frequency', 'like', '%'.$search.'%')->paginate(8)->appends(request()->query());
        }else{
            $frequencies = $query->orderBy('id','DESC')->paginate(8)->onEachSide(1);
        }
        return $frequencies;
    }

    public function scopeAjaxSearch($query,$search){
        if($search == ''):
            $frequencies = $query->select('id','frequency')->limit(5)->get();
        else:
            $frequencies = $query->select('id','frequency')->where('frequency', 'like', '%' .$search . '%')->limit(5)->get();
        endif;
        return $frequencies;
    }
}
