<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // $table->bigInteger('kecamatan_id')->unsigned();
            // $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('cascade')->onUpdate('cascade');
            // $table->bigInteger('cluster_id')->unsigned();
            // $table->foreign('cluster_id')->references('id')->on('clusters')->onDelete('cascade')->onUpdate('cascade');
            // $table->bigInteger('periode_tahun_id')->unsigned();
            // $table->foreign('periode_tahun_id')->references('id')->on('periode_tahuns')->onDelete('cascade')->onUpdate('cascade');
            // $table->bigInteger('jumlah_anak');
            // $table->bigInteger('jumlah_kasus_pendek');
            // $table->bigInteger('jumlah_kasus_sangatpendek');
            'kecamatan_id' => $this->kecamatan_id,
            'filegeo' => $this->kecamatan->FileGeo,
            'cluster_id' => $this->cluster_id,
            'periode_tahun_id' => $this->periode_tahun_id,
            'total_kasus' => $this->total_kasus,
            'nama_kecamatan' => $this->kecamatan->nama_kecamatan,
            'warna' => $this->cluster->warna
        ];
    }
}
