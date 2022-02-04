<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{

    protected $fillable = ['name', 'location', 'description'];


    use HasFactory;
    public function jails(){
        return $this->hasMany(Jail::class);
    }
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
