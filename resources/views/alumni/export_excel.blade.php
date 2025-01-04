<table>
    <thead>
        <tr>
            <th style="background-color:#D3D3D3">No</th>
            <th style="background-color:#D3D3D3">Nama</th>
            <th style="background-color:#D3D3D3">No Absen</th>
            <th style="background-color:#D3D3D3">No Reg</th>
            <th style="background-color:#D3D3D3">Tempat Lahir</th>
            <th style="background-color:#D3D3D3">Tanggal Lahir</th>
            <th style="background-color:#D3D3D3">Pelaksanaan Diklat</th>
            <th style="background-color:#D3D3D3">URL QR</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->no_absen }}</td>
                <td>{{ $row->no_reg }}</td>
                <td>{{ $row->tempat_lahir }}</td>
                <td>{{ $row->tanggal_lahir }}</td>
                <td>{{ $row->pelaksaan_diklat }}</td>
                <td>
                    {{-- Encrypt the no_absen field and generate the URL --}}
                    @php
                        $encryptedNoAbsen = \Crypt::encryptString($row->no_absen);
                        $url = url('web/alumni/' . urlencode($encryptedNoAbsen));
                    @endphp
                    <a href="{{ $url }}" target="_blank">{{ $url }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
