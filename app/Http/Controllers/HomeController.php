<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Kecamatan;
use App\Models\PeriodeTahun;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = "Dashboard Admin";
        $datakecamatan = Kecamatan::all()->count();
        $data = Data::select('kecamatan_id')
            ->selectRaw("SUM(jumlah_kasus_pendek) as total_kasus_pendek")
            ->selectRaw("SUM(jumlah_kasus_sangatpendek) as total_kasus_sangatpendek")
            ->groupBy('kecamatan_id')
            ->orderBy('kecamatan_id')
            ->get();
        $tahunmin = PeriodeTahun::has('data')
            ->selectRaw("MIN(tahun) as tahun_min")
            ->get();
        $tahunmax = PeriodeTahun::has('data')
            ->selectRaw("MAX(tahun) as tahun_max")
            ->get();
        $datakasuspendek = Data::selectRaw("SUM(jumlah_kasus_pendek) as total_kasus_pendek")->get();
        $datakasussangatpendek = Data::selectRaw("SUM(jumlah_kasus_sangatpendek) as total_kasus_sangatpendek")->get();
        // dd($tahunmax[0]->tahun_max);
        return view('admin.dashboard', compact('page', 'data', 'datakasuspendek', 'datakasussangatpendek', 'datakecamatan', 'tahunmin', 'tahunmax'));
    }
}
