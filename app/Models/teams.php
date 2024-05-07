<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teams extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'points', 'logo_path'];
    protected $guarded = [];

    public function tours() {
        return $this->belongsToMany('App\Models\Tour', 'team_tour');
    }
}
