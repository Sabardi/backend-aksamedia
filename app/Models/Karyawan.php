<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        "division_id",
        "name",
        "image",
        "phone",
    ];

    public function division(){
        return $this->belongsTo(Divisions::class, 'division_id');
    }
}
