<?php

namespace App\Http\Controllers;

use App\Imports\KecamatanImport;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::all();
        $page = "Daftar Kecamatan";
        return view('admin.kecamatan.index', compact('kecamatan', 'page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required',
            'geojson' => 'required|file:geojson|max:5000',
        ]);

        $kecamatan = new Kecamatan();
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;

        //save file ke storage
        $file = $request->file('geojson');
        $filegeojson = time() . $file->getClientOriginalName();
        $file->storeAs('public/geojson/', $filegeojson);

        $kecamatan->geojson = $filegeojson;

        //save ke database
        $kecamatan->save();

        Alert::success('Informasi Pesan', 'Berhasil Menambahkan Kecamatan');
        return redirect()->route('kecamatan.index');
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        return json_encode($kecamatan);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required',
            'geojson' => 'required|file:geojson|max:5000',
        ]);

        $kecamatan = Kecamatan::findOrFail($request->id);
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;

        // menghapus yang lama
        if ($request->geojson) {
            Storage::delete('public/geojson/' . $kecamatan->geojson);
        };

        // save yang baru
        $file = $request->file('geojson');
        $filegeojson = time() . $file->getClientOriginalName();
        $file->storeAs('public/geojson/', $filegeojson);

        $kecamatan->geojson = $filegeojson;

        //save kedatabase
        $kecamatan->save();

        Alert::success('Informasi Pesan', 'Berhasil Mengedit Kecamatan');
        return redirect()->route('kecamatan.index');
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        Storage::delete('public/geojson/' . $kecamatan->geojson);
        $kecamatan->delete();

        Alert::success('Informasi Pesan', 'Berhasil Menghapus Kecamatan');
        return redirect()->route('kecamatan.index');
    }
    public function importdata(Request $request)
    {
        // validate
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        Excel::import(new KecamatanImport, request()->file('file'));

        Alert::success('Informasi Pesan!', 'Kecamatan Berhasil diimport');
        return redirect()->route('kecamatan.index');
    }
}
