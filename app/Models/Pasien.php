<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pasien extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'nama', 'alamat', 'tempatlahir', 'tgllahir', 'jk'];
}
