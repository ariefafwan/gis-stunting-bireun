<?php

namespace App\Imports;

use App\Models\Data;
use App\Models\Kecamatan;
use App\Models\PeriodeTahun;
use Maatwebsite\Excel\Concerns\ToModel;

class DataImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $tahun = PeriodeTahun::where('tahun', $row[0])->pluck('id')->first();
        $kecamatan = Kecamatan::where('nama_kecamatan', $row[1])->pluck('id')->first();
        // dd($kecamatan);
        return new Data([
            'periode_tahun_id' => $tahun,
            'kecamatan_id' => $kecamatan,
            'jumlah_anak' => $row[2],
            'jumlah_kasus_pendek' => $row[3],
            'jumlah_kasus_sangatpendek' => $row[4],
        ]);
    }
}
