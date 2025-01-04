<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama">{{ __('Nama') }}</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ isset($alumni) ? $alumni->nama : old('nama') }}" placeholder="{{ __('Nama') }}" required />
            @error('nama')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-absen">{{ __('No Absen') }}</label>
            <input type="number" name="no_absen" id="no-absen"
                class="form-control @error('no_absen') is-invalid @enderror"
                value="{{ isset($alumni) ? $alumni->no_absen : old('no_absen') }}" placeholder="{{ __('No Absen') }}"
                required />
            @error('no_absen')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-reg">{{ __('No Reg') }}</label>
            <input type="number" name="no_reg" id="no-reg"
                class="form-control @error('no_reg') is-invalid @enderror"
                value="{{ isset($alumni) ? $alumni->no_reg : old('no_reg') }}" placeholder="{{ __('No Reg') }}"
                required />
            @error('no_reg')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tempat-lahir">{{ __('Tempat Lahir') }}</label>
            <input type="text" name="tempat_lahir" id="tempat-lahir"
                class="form-control @error('tempat_lahir') is-invalid @enderror"
                value="{{ isset($alumni) ? $alumni->tempat_lahir : old('tempat_lahir') }}"
                placeholder="{{ __('Tempat Lahir') }}" required />
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
            <input type="date" name="tanggal_lahir" id="tanggal-lahir"
                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                value="{{ isset($alumni) && $alumni->tanggal_lahir ? $alumni->tanggal_lahir->format('Y-m-d') : old('tanggal_lahir') }}"
                placeholder="{{ __('Tanggal Lahir') }}" required />
            @error('tanggal_lahir')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    @isset($alumni)
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($alumni->photo == null)
                        <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="Photo"
                            class="rounded mb-2 mt-2" alt="Photo" width="200" height="150"
                            style="object-fit: cover">
                    @else
                        <img src="{{ asset('uploads/photos/' . $alumni->photo) }}" alt="Photo" class="rounded mb-2 mt-2"
                            width="200" height="150" style="object-fit: cover">
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="form-group ms-3">
                        <label for="photo">{{ __('Photo') }}</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                            id="photo">

                        @error('photo')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        <div id="photoHelpBlock" class="form-text">
                            {{ __('Leave the photo blank if you don`t want to change it.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-6">
            <div class="form-group">
                <label for="photo">{{ __('Photo') }}</label>
                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                    id="photo" required>

                @error('photo')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    @endisset
    <div class="col-md-6">
        <div class="form-group">
            <label for="pelaksaan-diklat-id">{{ __('Pelaksaan Diklat') }}</label>
            <select class="form-select @error('pelaksaan_diklat_id') is-invalid @enderror" name="pelaksaan_diklat_id"
                id="pelaksaan-diklat-id" class="form-control">
                <option value="" selected disabled>-- {{ __('Select pelaksaan diklat') }} --</option>

                @foreach ($pelaksaanDiklats as $pelaksaanDiklat)
                    <option value="{{ $pelaksaanDiklat->id }}"
                        {{ isset($alumni) && $alumni->pelaksaan_diklat_id == $pelaksaanDiklat->id ? 'selected' : (old('pelaksaan_diklat_id') == $pelaksaanDiklat->id ? 'selected' : '') }}>
                        {{ $pelaksaanDiklat->judul_diklat }}
                    </option>
                @endforeach
            </select>
            @error('pelaksaan_diklat_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
