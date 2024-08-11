<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisions extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
    ];

    public function karyawan(){
        return $this->hasOne(Karyawan::class, 'division_id');
    }
}
