<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\Cluster;
use App\Models\Data;
use App\Models\Kecamatan;
use App\Models\PeriodeTahun;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $page = "Dashboard Admin";
        $datakecamatan = Kecamatan::all()->count();
        $data = Data::select('kecamatan_id', 'cluster_id', 'periode_tahun_id')
            ->selectRaw("SUM(jumlah_kasus_pendek) + SUM(jumlah_kasus_sangatpendek) as total_kasus")
            ->groupBy('kecamatan_id', 'cluster_id', 'periode_tahun_id')
            ->orderBy('kecamatan_id')
            ->get();

        // $dataall = json_encode($data);
        // dd($dataall);
        $tahun = PeriodeTahun::has('data')
            ->selectRaw("MIN(tahun) as tahun_min")
            ->selectRaw("MAX(tahun) as tahun_max")
            ->get();
        $pilihtahun = PeriodeTahun::has('data')->get();
        $datakasuspendek = Data::selectRaw("SUM(jumlah_kasus_pendek) as total_kasus_pendek")->get();
        $datakasussangatpendek = Data::selectRaw("SUM(jumlah_kasus_sangatpendek) as total_kasus_sangatpendek")->get();
        $cluster = Cluster::all();
        // dd($data[0]->total_kasus);
        return view('welcome', compact('page', 'data', 'datakasuspendek', 'datakasussangatpendek', 'datakecamatan', 'tahun', 'cluster', 'pilihtahun'));
    }

    public function userdata()
    {
        // $data = Data::select('kecamatan_id', 'cluster_id', 'periode_tahun_id')
        //     ->selectRaw("SUM(jumlah_kasus_pendek) + SUM(jumlah_kasus_sangatpendek) as total_kasus")
        //     ->groupBy('kecamatan_id', 'cluster_id', 'periode_tahun_id')
        //     ->orderBy('kecamatan_id')
        //     ->get();
        // return $data->toJson();
        return json_encode(DataResource::collection($data = Data::select('kecamatan_id', 'cluster_id', 'periode_tahun_id')
            ->selectRaw("SUM(jumlah_kasus_pendek) + SUM(jumlah_kasus_sangatpendek) as total_kasus")
            ->groupBy('kecamatan_id', 'cluster_id', 'periode_tahun_id')
            ->orderBy('kecamatan_id')
            ->get()));
    }
}
