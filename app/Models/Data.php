<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $fillable = ['kecamatan_id', 'periode_tahun_id', 'jumlah_anak', 'jumlah_kasus_pendek', 'jumlah_kasus_sangatpendek'];
    protected $with = ['kecamatan', 'periode_tahun'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function periode_tahun()
    {
        return $this->belongsTo(PeriodeTahun::class);
    }
}
