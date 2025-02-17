<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['nickname', 'fi', 'photo', 'teams_id', 'verified'];
    protected $guarded = [];


}
