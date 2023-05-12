<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    // mendaftarkan fitur softdeletes
    use SoftDeletes;
    protected $fillable = [
        'nama',
        'nis',
        'rombel',
        'rayon',
    ];
    // nonaktif timestamps (created_at dan updated_at) karena pada table yg dibuat tidak terdapat column tersebut
    // public $timestamps = false;
}
