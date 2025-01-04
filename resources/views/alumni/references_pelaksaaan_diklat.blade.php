<table>
    <thead>
        <tr>
            <th style="background-color:#D3D3D3 ">{{ __('ID Pelaksanaan Diklat') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Diklat') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Judul') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Angkata') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Tanggal Mulai') }}</th>
            <th style="background-color:#D3D3D3 ">{{ __('Tanggal Selesai') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->id }}</td>
                <td>{{ $dt->nama_diklat }}</td>
                <td>{{ $dt->judul_diklat }}</td>
                <td>{{ $dt->angkatan }}</td>
                <td>{{ $dt->tanggal_mulai }}</td>
                <td>{{ $dt->tanggal_selesai }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
