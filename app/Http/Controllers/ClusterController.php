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
            'desk' => 'required',
            'warna' => 'required',
        ]);

        $data = new Cluster();
        $data->nama_cluster = $request->nama_cluster;
        $data->warna = $request->warna;
        $data->desk = $request->desk;
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
            'desk' => 'required',
            'warna' => 'required',
        ]);

        $data = Cluster::findOrFail($request->id);
        $data->nama_cluster = $request->nama_cluster;
        $data->warna = $request->warna;
        $data->desk = $request->desk;
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
