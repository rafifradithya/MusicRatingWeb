<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'musics'; // 👈 TAMBAHKAN INI

    protected $fillable = ['title', 'poster', 'audio'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
