<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClusterController extends Controller
{
    public function index()
    {
        $cluster = Cluster::all();
        $page = "Cluster Penyebaran";
        return view('admin.cluster.index', compact('page', 'cluster'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cluster' => 'required',
            'jarak_terjauh' => 'required',
            'jarak_terdekat' => 'required',
            'warna' => 'required',
        ]);

        $data = new Cluster();
        $data->nama_cluster = $request->nama_cluster;
        $data->jarak_terjauh = $request->jarak_terjauh;
        $data->jarak_terdekat = $request->jarak_terdekat;
        $data->warna = $request->warna;
        //save data
        $data->save();

        Alert::success('Informasi Pesan', 'Berhasil Menambahkan Data Cluster');
        return redirect()->route('cluster.index');
    }

    public function edit($id)
    {
        $cluster = Cluster::findOrFail($id);
        return json_encode($cluster);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_cluster' => 'required',
            'jarak_terjauh' => 'required',
            'jarak_terdekat' => 'required',
            'warna' => 'required',
        ]);

        $data = Cluster::findOrFail($request->id);
        $data->nama_cluster = $request->nama_cluster;
        $data->jarak_terjauh = $request->jarak_terjauh;
        $data->jarak_terdekat = $request->jarak_terdekat;
        $data->warna = $request->warna;
        //save data
        $data->save();

        Alert::success('Informasi Pesan', 'Berhasil Mengedit Cluster');
        return redirect()->route('cluster.index');
    }

    public function destroy($id)
    {
        $cluster = Cluster::findOrFail($id);
        $cluster->delete();

        Alert::success('Informasi Pesan', 'Berhasil Menghapus Cluster');
        return redirect()->route('cluster.index');
    }
}
