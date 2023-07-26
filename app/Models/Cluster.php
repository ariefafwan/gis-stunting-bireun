<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $fillable = ['nama_cluster', 'warna', 'jarak_terdekat', 'jarak_terjauh'];
    protected $guarded = [];

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
