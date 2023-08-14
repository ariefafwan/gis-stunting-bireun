<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['nama_kecamatan', 'geojson'];

    public function data()
    {
        return $this->hasMany(Data::class);
    }

    public function getFileGeoAttribute()
    {
        $file = $this->geojson;
        return asset('storage/geojson/' . $file);
    }
}
