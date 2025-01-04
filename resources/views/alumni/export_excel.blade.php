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
            <th style="background-color:#D3D3D3">URL No Register</th>
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
                    @php
                        $hashedNoAbsen = substr(md5($row->no_reg), 0, 8);
                        $randomUrl = url('detail/' . urlencode($hashedNoAbsen));
                    @endphp
                    <a href="{{ $randomUrl }}" target="_blank">{{ $randomUrl }}</a>
                </td>
                <td>
                    @php
                        $directUrl = url('detail/' . urlencode($row->no_reg));
                    @endphp
                    <a href="{{ $directUrl }}" target="_blank">{{ $directUrl }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
