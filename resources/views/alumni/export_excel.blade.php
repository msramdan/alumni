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
            <th style="background-color:#D3D3D3">URL Random</th>
            <th style="background-color:#D3D3D3">URL No Absen</th>
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
                    {{-- Hash the no_absen field and generate the URL --}}
                    @php
                        // Create a hash of no_absen and truncate it to 8 characters
                        $hashedNoAbsen = substr(md5($row->no_absen), 0, 8);
                        $randomUrl = url('web/alumni/' . urlencode($hashedNoAbsen));
                    @endphp
                    <a href="{{ $randomUrl }}" target="_blank">{{ $randomUrl }}</a>
                </td>
                <td>
                    {{-- Direct URL using no_absen --}}
                    @php
                        $directUrl = url('web/alumni/' . urlencode($row->no_absen));
                    @endphp
                    <a href="{{ $directUrl }}" target="_blank">{{ $directUrl }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
