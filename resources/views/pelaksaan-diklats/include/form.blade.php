<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="diklat-id">{{ __('Diklat') }}</label>
            <select class="form-select @error('diklat_id') is-invalid @enderror" name="diklat_id" id="diklat-id" class="form-control">
                <option value="" selected disabled>-- {{ __('Select diklat') }} --</option>
                
                        @foreach ($diklats as $diklat)
                            <option value="{{ $diklat->id }}" {{ isset($pelaksaanDiklat) && $pelaksaanDiklat->diklat_id == $diklat->id ? 'selected' : (old('diklat_id') == $diklat->id ? 'selected' : '') }}>
                                {{ $diklat->nama_diklat }}
                            </option>
                        @endforeach
            </select>
            @error('diklat_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="angkatan">{{ __('Angkatan') }}</label>
            <input type="text" name="angkatan" id="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{ isset($pelaksaanDiklat) ? $pelaksaanDiklat->angkatan : old('angkatan') }}" placeholder="{{ __('Angkatan') }}" required />
            @error('angkatan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal-mulai">{{ __('Tanggal Mulai') }}</label>
            <input type="date" name="tanggal_mulai" id="tanggal-mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ isset($pelaksaanDiklat) && $pelaksaanDiklat->tanggal_mulai ? $pelaksaanDiklat->tanggal_mulai->format('Y-m-d') : old('tanggal_mulai') }}" placeholder="{{ __('Tanggal Mulai') }}" required />
            @error('tanggal_mulai')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal-selesai">{{ __('Tanggal Selesai') }}</label>
            <input type="date" name="tanggal_selesai" id="tanggal-selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ isset($pelaksaanDiklat) && $pelaksaanDiklat->tanggal_selesai ? $pelaksaanDiklat->tanggal_selesai->format('Y-m-d') : old('tanggal_selesai') }}" placeholder="{{ __('Tanggal Selesai') }}" required />
            @error('tanggal_selesai')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="kotum">{{ __('Kota') }}</label>
            <input type="text" name="kota" id="kotum" class="form-control @error('kota') is-invalid @enderror" value="{{ isset($pelaksaanDiklat) ? $pelaksaanDiklat->kota : old('kota') }}" placeholder="{{ __('Kota') }}" required />
            @error('kota')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="provinsi">{{ __('Provinsi') }}</label>
            <input type="text" name="provinsi" id="provinsi" class="form-control @error('provinsi') is-invalid @enderror" value="{{ isset($pelaksaanDiklat) ? $pelaksaanDiklat->provinsi : old('provinsi') }}" placeholder="{{ __('Provinsi') }}" required />
            @error('provinsi')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>