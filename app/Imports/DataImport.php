<?php

namespace App\Imports;

use App\Models\Data;
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
        return new Data([
            'kecamatan_id' => $row[0],
            'periode_tahun_id' => $row[1],
            'jumlah_anak' => $row[2],
            'jumlah_kasus_pendek' => $row[3],
            'jumlah_kasus_sangatpendek' => $row[4],
        ]);
    }
}
