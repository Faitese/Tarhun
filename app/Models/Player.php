<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['nickname', 'fi', 'photo', 'team_id', 'verified'];
    protected $guarded = [];


}
