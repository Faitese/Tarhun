<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'prize_pool', 'teams', 'org_img', 'large_img', 'start_date', 'end_date'];

    protected $guarded = [];

    public function teams() {
        return $this->belongsToMany('App\Models\teams', 'team_tour');
    }
}
