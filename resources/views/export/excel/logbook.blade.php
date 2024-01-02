<table>
    <thead>
        <tr>
            <th>Jam Kerja</th>
            <th>Kegiatan</th>
            <th>Lokasi</th>
            <th>Bersama</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <th>{{ $value->jam_kerja }}</th>
                <th>{{ $value->kegiatan }}</th>
                <th>{{ $value->lokasi }}</th>
                <th>{{ $value->bersama }}</th>
            </tr>
        @endforeach
    </tbody>
</table>

<table>
    <tr>
        <th>Nama</th>
        <th>{{ $nama->nama }}</th>
        <th>Shift</th>
        <th>{{ $nama->shift }}</th>
    </tr>
</table>
