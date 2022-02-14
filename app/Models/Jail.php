<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jail extends Model
{

    protected $fillable = ['name', 'code', 'type', 'capacity', 'ward_id','description'];

    use HasFactory;

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }


}
