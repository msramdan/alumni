@extends('layouts.app')

@section('title', __('alumni'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('alumni') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all alumni.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/panel">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('alumni') }}</li>
                </x-breadcrumb>
            </div>
        </div>
        <section class="section">
            <x-alert></x-alert>

            @can('alumni create')
                <div class="d-flex justify-content-end mb-3">
                    <!-- Create Button -->
                    <a href="{{ route('alumni.create') }}" class="btn btn-primary mr-2">
                        <i class="fas fa-plus"></i>
                        {{ __('Create a new alumni') }}
                    </a>&nbsp;

                    <!-- Export Button -->
                    <a href="{{ route('alumni.export') }}" class="btn btn-success mr-2">
                        <i class="fas fa-download"></i>
                        {{ __('Export') }}
                    </a>&nbsp;

                    <!-- Import Button with Modal Trigger -->
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="fas fa-upload"></i>
                        {{ __('Import') }}
                    </button>
                </div>
            @endcan

            <!-- Import Modal -->
            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">{{ __('Import Alumni Data') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('alumni.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="file" class="form-label">{{ __('Select File') }}</label>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Import') }}</button>
                            </form>
                            <hr>
                            <a href="{{ route('format.import') }}" >{{ __('Download Import Format') }}</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Nama') }}</th>
                                            <th>{{ __('No Absen') }}</th>
                                            <th>{{ __('No Reg') }}</th>
                                            <th>{{ __('Tempat Lahir') }}</th>
                                            <th>{{ __('Tanggal Lahir') }}</th>
                                            <th>{{ __('Photo') }}</th>
                                            <th>{{ __('Pelaksaan Diklat') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('alumni.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                }, {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'no_absen',
                    name: 'no_absen',
                },
                {
                    data: 'no_reg',
                    name: 'no_reg',
                },
                {
                    data: 'tempat_lahir',
                    name: 'tempat_lahir',
                },
                {
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir',
                },
                {
                    data: 'photo',
                    name: 'photo',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return `<div class="avatar">
                            <img src="${data}" alt="Photo" >
                        </div>`;
                    }
                },
                {
                    data: 'judul_diklat',
                    name: 'pelaksaan_diklat.judul_diklat'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });
    </script>
@endpush
