<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Imports\DataImport;
use App\Models\Cluster;
use App\Models\Data;
use App\Models\Kecamatan;
use App\Models\PeriodeTahun;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index()
    {
        $data = Data::all();
        $periode = PeriodeTahun::all();
        $kecamatan = Kecamatan::all();
        $tahun = PeriodeTahun::select('tahun')->get();
        $page = "Data Penyebaran Stunting";
        $cluster = Cluster::all();
        return view('admin.data.index', compact('data', 'page', 'periode', 'kecamatan', 'tahun', 'cluster'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kecamatan_id' => 'required',
            'periode_tahun_id' => 'required',
            'jumlah_anak' => 'required',
            'cluster_id' => 'required',
            'jumlah_kasus_pendek' => 'required',
            'jumlah_kasus_sangatpendek' => 'required',
        ]);

        $data = new Data();
        $data->kecamatan_id = $request->kecamatan_id;
        $data->cluster_id = $request->cluster_id;
        $data->periode_tahun_id = $request->periode_tahun_id;
        $data->jumlah_anak = $request->jumlah_anak;
        $data->jumlah_kasus_pendek = $request->jumlah_kasus_pendek;
        $data->jumlah_kasus_sangatpendek = $request->jumlah_kasus_sangatpendek;
        //save data
        $data->save();

        Alert::success('Informasi Pesan', 'Berhasil Menambahkan Data Kasus');
        return redirect()->route('data.index');
    }

    public function edit($id)
    {
        $data = Data::findOrFail($id);
        return json_encode($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'kecamatan_id' => 'required',
            'periode_tahun_id' => 'required',
            'jumlah_anak' => 'required',
            'cluster_id' => 'required',
            'jumlah_kasus_pendek' => 'required',
            'jumlah_kasus_sangatpendek' => 'required',
        ]);

        $data = Data::findOrFail($request->id);
        $data->kecamatan_id = $request->kecamatan_id;
        $data->cluster_id = $request->cluster_id;
        $data->periode_tahun_id = $request->periode_tahun_id;
        $data->jumlah_anak = $request->jumlah_anak;
        $data->jumlah_kasus_pendek = $request->jumlah_kasus_pendek;
        $data->jumlah_kasus_sangatpendek = $request->jumlah_kasus_sangatpendek;
        //save data
        $data->save();

        Alert::success('Informasi Pesan', 'Berhasil Mengupdate Data Kasus');
        return redirect()->route('data.index');
    }

    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        $data->delete();

        Alert::success('Informasi Pesan', 'Berhasil Menghapus Data Kasus');
        return redirect()->route('data.index');
    }

    public function tahunindex()
    {
        $tahun = PeriodeTahun::all();
        $page = "Data Periode Tahun Penyebaran";
        return view('admin.tahun.index', compact('tahun', 'page'));
    }

    public function tahunstore(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        $tahun = new PeriodeTahun();
        $tahun->tahun = $request->tahun;
        //save data
        $tahun->save();

        Alert::success('Informasi Pesan', 'Berhasil Menambahkan Data Periode Kasus');
        return redirect()->route('tahun.index');
    }

    public function tahundestroy($id)
    {
        $tahun = PeriodeTahun::findOrFail($id);
        $tahun->delete();

        Alert::success('Informasi Pesan', 'Berhasil Menghapus Data Periode Kasus');
        return redirect()->route('tahun.index');
    }

    public function importdata(Request $request)
    {
        // validate
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        Excel::import(new DataImport, request()->file('file'));

        Alert::success('Informasi Pesan!', 'Data Berhasil diimport');
        return redirect()->route('data.index');
    }

    public function exportdata()
    {
        return Excel::download(new DataExport, 'DataProduksi.xlsx');
    }
}
