@extends('layouts.app')

@section('title', __('Detail of alumni'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('alumni') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of alumni.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/panel">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('alumni.index') }}">{{ __('alumni') }}</a>
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
                                        <td class="fw-bold">{{ __('Nama') }}</td>
                                        <td>{{ $alumni->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('No Absen') }}</td>
                                        <td>{{ $alumni->no_absen }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('No Reg') }}</td>
                                        <td>{{ $alumni->no_reg }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tempat Lahir') }}</td>
                                        <td>{{ $alumni->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tanggal Lahir') }}</td>
                                        <td>{{ $alumni->tanggal_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Photo') }}</td>
                                        <td>
                                            @if ($alumni->photo == null)
                                                <img src="https://via.placeholder.com/350?text=No+Image+Avaiable"
                                                    alt="Photo" class="rounded" width="200" height="150"
                                                    style="object-fit: cover">
                                            @else
                                                <img src="{{ asset('uploads/photos/' . $alumni->photo) }}" alt="Photo"
                                                    class="rounded" width="200" height="150" style="object-fit: cover">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Pelaksaan Diklat') }}</td>
                                        <td>{{ $alumni->judul_diklat }}
                                        </td>
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
