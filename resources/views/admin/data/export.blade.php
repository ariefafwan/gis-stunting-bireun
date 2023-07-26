<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Periode Tahun Kasus</th>
            <th>Kecamatan</th>
            <th>Cluster</th>
            <th>Jumlah Anak</th>
            <th>Jumlah Kasus Pendek</th>
            <th>Jumlah Kasus Sangat Pendek</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $row)
        <tr>
            <td scope="row">{{ $index + 1 }}</td>
            <td>{{ $row->periodetahun->tahun }}</td>
            <td>{{ $row->kecamatan->nama_kecamatan }}</td>
            <td>{{ $row->cluster->nama_cluster }}</td>
            <td>{{ $row->jumlah_anak }}</td>
            <td>{{ $row->jumlah_kasus_pendek }}</td>
            <td>{{ $row->jumlah_kasus_sangatpendek }}</td>
        </tr>
        @endforeach
    </tbody>
</table>