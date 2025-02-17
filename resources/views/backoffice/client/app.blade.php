@extends('layouts.backoffice.main')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Daftar client</h5>
                <a href="{{ route('client.create') }}" class="btn btn-primary">Tambah client</a>
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
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->status->value }}</td>
                                    <td>
                                        <a href="{{ route('client.edit', $client->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button class="btn btn-sm btn-danger delete-btn"
                                            data-url="{{ route('client.destroy', $client->id) }}">
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
    @include('backoffice.client.script')
@endsection
