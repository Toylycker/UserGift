<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'user_id',
        'parent_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function gifts(){
        return $this->hasMany(Gift::class, 'parent_id')->with('gifts');
    }

}

