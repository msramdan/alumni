@extends('layouts.app')

@section('title', __('Detail of Pelaksanaan Diklat'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Pelaksanaan Diklat') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of pelaksaan diklat.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/panel">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('pelaksaan-diklats.index') }}">{{ __('Pelaksanaan Diklat') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <td class="fw-bold">{{ __('Diklat') }}</td>
                                        <td>{{ $pelaksaanDiklat->diklat ? $pelaksaanDiklat->diklat->nama_diklat : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Angkatan') }}</td>
                                        <td>{{ $pelaksaanDiklat->angkatan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tanggal Mulai') }}</td>
                                        <td>{{ isset($pelaksaanDiklat->tanggal_mulai) ? \Carbon\Carbon::parse($pelaksaanDiklat->tanggal_mulai)->format('d/m/Y') : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tanggal Selesai') }}</td>
                                        <td>{{ isset($pelaksaanDiklat->tanggal_selesai) ? \Carbon\Carbon::parse($pelaksaanDiklat->tanggal_selesai)->format('d/m/Y') : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Kota') }}</td>
                                        <td>{{ $pelaksaanDiklat->kota }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Provinsi') }}</td>
                                        <td>{{ $pelaksaanDiklat->provinsi }}</td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
