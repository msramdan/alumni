<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-diklat">{{ __('Nama Diklat') }}</label>
            <input type="text" name="nama_diklat" id="nama-diklat" class="form-control @error('nama_diklat') is-invalid @enderror" value="{{ isset($diklat) ? $diklat->nama_diklat : old('nama_diklat') }}" placeholder="{{ __('Nama Diklat') }}" required />
            @error('nama_diklat')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>