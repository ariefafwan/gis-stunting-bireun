<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $fillable = ['kecamatan_id', 'periode_tahun_id', 'jumlah_anak', 'jumlah_kasus_pendek', 'jumlah_kasus_sangatpendek', 'cluster_id'];
    protected $with = ['kecamatan', 'periode_tahun', 'cluster'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }

    public function getFileGeoAttribute()
    {
        $file = $this->kecamatan->geojson;
        return asset('storage/geojson/' . $file);
    }

    public function periode_tahun()
    {
        return $this->belongsTo(PeriodeTahun::class);
    }

    // public static function getJenisNameAttribute()
    // {
    //     $data = Data::select('kecamatan_id')
    //         ->selectRaw("SUM(jumlah_kasus_pendek) + SUM(jumlah_kasus_sangatpendek) as total_kasus")
    //         ->groupBy('kecamatan_id')
    //         ->orderBy('kecamatan_id')
    //         ->get();

    //     if ($data->total_kasus <= 10) {
    //         return "#00FF7F";
    //     } elseif ($data->total_kasus <= 10) {
    //         return "#FFFF00";
    //     }
    // }
}
