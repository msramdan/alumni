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
                        <a href="/">{{ __('Dashboard') }}</a>
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
                                            <td class="fw-bold">{{ __('No Reg') }}</td>
                                            <td>{{ $alumni->no_reg }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Nama') }}</td>
                                            <td>{{ $alumni->nama }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tempat Lahir') }}</td>
                                            <td>{{ $alumni->tempat_lahir }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tanggal Lahir') }}</td>
                                            <td>{{ isset($alumni->tanggal_lahir) ? $alumni->tanggal_lahir->format('Y-m-d') : ''  }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $alumni->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $alumni->updated_at->format('Y-m-d H:i:s') }}</td>
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
