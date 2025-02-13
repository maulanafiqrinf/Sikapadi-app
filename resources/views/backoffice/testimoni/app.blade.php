@extends('layouts.backoffice.main')

@section('title', 'Daftar testimoni')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Daftar testimoni</h5>
                <a href="{{ route('testimoni.create') }}" class="btn btn-primary">Tambah testimoni</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonis as $testimoni)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $testimoni->title }}</td>
                                    <td>{{ $testimoni->status->value }}</td>
                                    <td>
                                        <a href="{{ route('testimoni.edit', $testimoni->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button class="btn btn-sm btn-danger delete-btn"
                                            data-url="{{ route('testimoni.destroy', $testimoni->id) }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('backoffice.testimoni.script')
@endsection
