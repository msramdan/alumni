<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-reg">{{ __('No Reg') }}</label>
            <input type="number" name="no_reg" id="no-reg" class="form-control @error('no_reg') is-invalid @enderror" value="{{ isset($alumni) ? $alumni->no_reg : old('no_reg') }}" placeholder="{{ __('No Reg') }}" required />
            @error('no_reg')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">{{ __('Nama') }}</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ isset($alumni) ? $alumni->nama : old('nama') }}" placeholder="{{ __('Nama') }}" required />
            @error('nama')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tempat-lahir">{{ __('Tempat Lahir') }}</label>
            <input type="text" name="tempat_lahir" id="tempat-lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ isset($alumni) ? $alumni->tempat_lahir : old('tempat_lahir') }}" placeholder="{{ __('Tempat Lahir') }}" required />
            @error('tempat_lahir')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal-lahir">{{ __('Tanggal Lahir') }}</label>
            <input type="date" name="tanggal_lahir" id="tanggal-lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ isset($alumni) && $alumni->tanggal_lahir ? $alumni->tanggal_lahir->format('Y-m-d') : old('tanggal_lahir') }}" placeholder="{{ __('Tanggal Lahir') }}" required />
            @error('tanggal_lahir')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
