<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    /** @use HasFactory<\Database\Factories\ObatFactory> */
    use HasFactory;
    protected $fillable = ['nama', 'harga', 'status'];

    public function index()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
