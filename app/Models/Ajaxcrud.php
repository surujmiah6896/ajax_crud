<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Ajaxcrud extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
